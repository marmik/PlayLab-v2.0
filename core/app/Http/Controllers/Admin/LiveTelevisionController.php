<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveTelevision;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class LiveTelevisionController extends Controller {
    public function index() {
        $pageTitle   = "Live Televisions";
        $televisions = LiveTelevision::latest()->paginate(getPaginate());
        return view('admin.television.index', compact('pageTitle', 'televisions'));
    }

    public function store(Request $request, $id = 0) {
        $imageValidate = $id == 0 ? 'required' : 'nullable';
        $validate      = [
            'title'       => 'required|max: 40|unique:live_televisions,title,' . $id,
            'url'         => 'required',
            'description' => 'required|string',
            'image'       => [$imageValidate, 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ];
        $request->validate($validate);

        if ($id == 0) {
            $television   = new LiveTelevision();
            $notification = 'Television added successfully.';
            $oldFile      = null;
        } else {
            $television         = LiveTelevision::findOrFail($id);
            $television->status = $request->status ? 1 : 0;
            $notification       = 'Television updated successfully';
            $oldFile            = $television->image;
        }

        if ($request->hasFile('image')) {
            try {
                $television->image = fileUploader($request->image, getFilePath('television'), getFileSize('television'), $oldFile);
            } catch (\Exception$e) {
                $notify[] = ['error', 'Image could not be uploaded'];
                return back()->withNotify($notify);
            }

        }

        $television->title       = $request->title;
        $television->url         = $request->url;
        $television->description = $request->description;
        $television->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function delete(Request $request) {
        $television = LiveTelevision::findOrFail($request->id);
        fileManager()->removeFile(getFilePath('television') . '/' . $television->image);
        $television->delete();

        $notify[] = ['success', 'Television deleted successfully'];
        return back()->withNotify($notify);
    }

}
