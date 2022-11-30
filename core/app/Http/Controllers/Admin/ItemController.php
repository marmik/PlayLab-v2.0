<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\VideoUploader;
use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\Item;
use App\Models\SubCategory;
use App\Models\Video;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller {
    private $notify;

    public function items() {
        $pageTitle = "Video Items";
        $items     = $this->itemsData();
        return view('admin.item.index', compact('pageTitle', 'items'));
    }

    public function singleItems() {
        $pageTitle = "Single Video Items";
        $items     = $this->itemsData('singleItems');
        return view('admin.item.index', compact('pageTitle', 'items'));
    }

    public function episodeItems() {
        $pageTitle = "Episode Video Items";
        $items     = $this->itemsData('episodeItems');
        return view('admin.item.index', compact('pageTitle', 'items'));
    }

    public function trailerItems() {
        $pageTitle = "Trailer Video Items";
        $items     = $this->itemsData('trailerItems');
        return view('admin.item.index', compact('pageTitle', 'items'));
    }

    private function itemsData($scope = null) {

        if ($scope) {
            $items = Item::$scope()->with('category', 'sub_category', 'video');
        } else {
            $items = Item::with('category', 'sub_category', 'video');
        }

        $search = request()->search;
        $items  = $items->where(function ($query) use ($search) {
            $query->orWhere('title', 'LIKE', "%$search%")->orWhereHas('category', function ($category) use ($search) {
                $category->where('name', 'LIKE', "%$search%");
            });
        });

        $items = $items->orderBy('id', 'desc')->paginate(getPaginate());

        return $items;

    }

    public function create() {
        $pageTitle  = "Add Item";
        $categories = Category::active()->with(['subcategories' => function ($subcategory) {
            $subcategory->where('status', 1);
        },
        ])->orderBy('id', 'desc')->get();
        return view('admin.item.singleCreate', compact('pageTitle', 'categories'));
    }

    public function store(Request $request) {
     
        $this->itemValidation($request, 'create');

        $team = [
            'director' => $request->director,
            'producer' => $request->producer,
            'casts'    => implode(',', $request->casts),
        ];

        $item  = new Item();
        $image = $this->imageUpload($request, $item, 'update');

        $item->item_type  = $request->item_type;
        $item->featured = 0;
        $request->version = $request->item_type == 1 ? $request->version : 0;

        $this->saveItem($request, $team, $image, $item);

        $notify[] = ['success', 'Item added successfully'];

        if ($request->item_type == 2) {
            return redirect()->route('admin.item.episodes', $item->id)->withNotify($notify);
        } else {
            return redirect()->route('admin.item.uploadVideo', $item->id)->withNotify($notify);
        }

    }

    public function edit($id) {
        $item       = Item::findOrFail($id);
        $pageTitle  = "Edit : " . $item->title;
        $categories = Category::active()->with(['subcategories' => function ($subcategory) {
            $subcategory->where('status', 1);
        },
        ])->orderBy('id', 'desc')->get();
        $subcategories = SubCategory::where('status', 1)->where('category_id', $item->category_id)->orderBy('id', 'desc')->get();
        return view('admin.item.edit', compact('pageTitle', 'item', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id) {
        $this->itemValidation($request, 'update');

        $team = [
            'director' => $request->director,
            'producer' => $request->producer,
            'casts'    => implode(',', $request->casts),
        ];

        $item = Item::findOrFail($id);

        if ($request->single) {

            if (!$request->status) {
                $notify[] = ['warning', 'Single selection item will not be inactive'];
                return back()->withNotify($notify);
            }

            // if (!$item->video) {
            //     $notify[] = ['warning', 'Single selection item must have a video'];
            //     return back()->withNotify($notify);
            // }

            $exist         = Item::where('single', 1)->first();
            if($exist){
                // $exist->single = 0;
                // $exist->save();
            }
            $item->single = 1;
        }

        $item->status   = $request->status ? 1 : 0;
        $item->trending = $request->trending ? 1 : 0;
        $item->featured = $request->featured ? 1 : 0;
        $image          = $this->imageUpload($request, $item, 'update');

        if ($image == 'error') {
            return back()->withNotify([$this->notify]);
        }

        $this->saveItem($request, $team, $image, $item);

        $notify[] = ['success', 'Item updated successfully'];
        return back()->withNotify($notify);
    }

    private function itemValidation($request, $type) {
        $validation = $type == 'create' ? 'required' : 'nullable';

        $request->validate([
            'title'           => 'required',
            'category'        => 'required',
            'sub_category_id' => 'nullable',
            'preview_text'    => 'required',
            'description'     => 'required',
            'director'        => 'required',
            'producer'        => 'required',
            'casts'           => 'required',
            'tags'            => 'required',
            'item_type'       => "$validation|in:1,2,3",
            'version'         => 'nullable|required_if:item_type,==,1|in:0,1',
            'portrait'        => ["$validation", 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            // 'landscape'       => ["$validation", 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'ratings'         => 'required|numeric',
        ]);
    }

    private function imageUpload($request, $item, $type) {
        $landscape = @$item->image->landscape;
        $portrait  = @$item->image->portrait;

        if ($request->hasFile('landscape')) {
            $maxLandScapSize = $request->landscape->getSize() / 3000000;

            if ($maxLandScapSize > 3) {
                $this->notify = ['error', 'Landscape image size could not be greater than 3mb'];
                return 'error';
            }

            try {
                $date = date('Y') . '/' . date('m') . '/' . date('d');
                $type == 'update' ? fileManager()->removeFile(getFilePath('item_landscape') . @$item->image->landscape) : '';
                $landscape = $date . '/' . fileUploader($request->landscape, getFilePath('item_landscape') . $date);
            } catch (\Exception$e) {
                $this->notify = ['error', 'Landscape image could not be uploaded'];
                return 'error';
            }

        }

        if ($request->hasFile('portrait')) {
            $maxLandScapSize = $request->portrait->getSize() / 3000000;

            if ($maxLandScapSize > 3) {
                $this->notify = ['error', 'Portrait image size could not be greater than 3mb'];
                return 'error';
            }

            try {
                $date = date('Y') . '/' . date('m') . '/' . date('d');
                $type == 'update' ? fileManager()->removeFile(getFilePath('item_portrait') . @$item->image->portrait) : '';
                $portrait = $date . '/' . fileUploader($request->portrait, getFilePath('item_portrait') . $date);
            } catch (\Exception$e) {
                $this->notify = ['error', 'Portrait image could not be uploaded'];
                return 'error';
            }

        }

        $image = [
            'landscape' => $landscape,
            'portrait'  => $portrait,
        ];
        return $image;
    }

    private function saveItem($request, $team, $image, $item) {
        $version = $request->version ? 1 : 0;
        if ($request->item_type && $request->item_type == 2) {
            $version = 2;
        }
        $item->category_id     = $request->category;
        $item->sub_category_id = $request->sub_category_id;
        $item->title           = $request->title;
        $item->preview_text    = $request->preview_text;
        $item->description     = $request->description;
        $item->team            = $team;
        $item->tags            = implode(',', $request->tags);
        $item->image           = $image;
        $item->version         = $version;
        $item->ratings         = $request->ratings;
        $item->save();
    }

    public function uploadVideo($id) {
        $item  = Item::findOrFail($id);
        $video = $item->video;

        if ($video) {
            $notify[] = ['error', 'Already video exist'];
            return back()->withNotify($notify);
        }

        $pageTitle = "Upload video to: " . $item->title;
        $prevUrl   = route('admin.item.index');
        return view('admin.item.video.upload', compact('item', 'pageTitle', 'video', 'prevUrl'));
    }

    public function upload(Request $request, $id) {
        ini_set('memory_limit', '-1');
        $validation_rule['video_type'] = 'required';
        $validation_rule['link']       = 'required_without:video';

        if ($request->video_type == 1) {
            $validation_rule['video'] = ['required_without:link', new FileTypeValidate(['mp4', 'mkv', '3gp'])];
        }

        $validator = Validator::make($request->all(), $validation_rule);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $item  = Item::findOrFail($id);
        $video = $item->video;

        if ($video) {
            return response()->json(['errors' => 'Already video exist']);
        }

        if ($request->hasFile('video')) {
            $file      = $request->file('video');
            $videoSize = $file->getSize();

            if ($videoSize > 4194304000) {
                return response()->json(['errors' => 'File size must be lower then 4 gb']);
            }

            $videoUploader       = new VideoUploader();
            $videoUploader->file = $file;
            $videoUploader->upload();

            $error = $videoUploader->error;

            if ($error) {
                return response()->json(['errors' => 'Could not upload the Video']);
            }

            $server = $videoUploader->uploadedServer;
            $video  = $videoUploader->fileName;

        } else {
            $video  = $request->link;
            $server = 2;
        }

        $videoObj             = new Video();
        $videoObj->item_id    = $item->id;
        $videoObj->video_type = $request->video_type;
        $videoObj->content    = $video;
        $videoObj->server     = $server;
        $videoObj->save();

        return response()->json('success');
    }

    public function updateVideo(Request $request, $id) {
        $item  = Item::findOrFail($id);
        $video = $item->video;

        if (!$video) {
            $notify[] = ['error', 'Video not found'];
            return back()->withNotify($notify);
        }

        $pageTitle = "Update video of: " . $item->title;
        $image     = getImage(getFilePath('item_landscape') . @$item->image->landscape);
        $general   = GeneralSetting::first();

        if ($video->server == 0) {
            $videoFile = asset('assets/videos/' . $video->content);
        } elseif ($video->server == 1) {
            $storage   = Storage::disk('custom-ftp');
            $videoFile = $general->ftp->domain . '/' . Storage::disk('custom-ftp')->url($video->content);
        } else {
            $videoFile = $video->content;
        }

        $prevUrl = route('admin.item.index');
        return view('admin.item.video.update', compact('item', 'pageTitle', 'video', 'videoFile', 'image', 'prevUrl'));
    }

    public function updateItemVideo(Request $request, $id) {
        ini_set('memory_limit', '-1');
        $validation_rule['video_type'] = 'required';
        $validation_rule['link']       = 'required_without:video';

        if ($request->video_type == 1) {
            $validation_rule['video'] = ['required_without:link', new FileTypeValidate(['mp4', 'mkv', '3gp'])];
        }

        $validator = Validator::make($request->all(), $validation_rule);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $item  = Item::findOrFail($id);
        $video = $item->video;

        if (!$video) {
            return response()->json(['errors' => 'Video not found']);
        }

        $videoUploader            = new VideoUploader();
        $videoUploader->oldFile   = $video->content;
        $videoUploader->oldServer = $video->server;

        if ($request->hasFile('video')) {
            $file      = $request->file('video');
            $videoSize = $file->getSize();

            if ($videoSize > 4194304000) {
                return response()->json(['errors' => 'File size must be lower then 4 gb']);
            }

            $videoUploader->file = $file;
            $videoUploader->upload();

            $error = $videoUploader->error;

            if ($error) {
                return response()->json(['errors' => 'Could not upload the Video']);
            }

            $content = $videoUploader->fileName;
            $server  = $videoUploader->uploadedServer;

        } else {
            $videoUploader->removeOldFile();

            $content = $request->link;
            $server  = 2;
        }

        $video->item_id    = $item->id;
        $video->video_type = $request->video_type;
        $video->content    = $content;
        $video->server     = $server;
        $video->save();

        return response()->json('success');
    }

    public function itemList(Request $request) {
        $items = Item::query();

        if (request()->search) {
            $items = $items->where('title', 'like', "%$request->search%");
        }

        $items = $items->latest()->paginate(getPaginate());

        foreach ($items as $item) {
            $response[] = [
                'id'   => $item->id,
                'text' => $item->title,
            ];
        }

        return $response ?? [];
    }

}
