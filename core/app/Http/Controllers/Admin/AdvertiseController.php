<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    public function index(){
    	$ads = Advertise::orderBy('id','desc')->paginate(getPaginate());
    	$pageTitle = "Advertises";
    	return view('admin.advertise.index',compact('ads','pageTitle'));
    }

    public function store(Request $request, $id = 0){
    	$request->validate([
            'title' => 'required',
            'type' => 'required',
			'image' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png', 'gif'])]
        ]);

		if($id == 0){
			$advertise =  new Advertise();
			$notification = 'Advertise added successfully';
			$filename = $this->imageUpload($request);
		}else{
			$advertise = Advertise::findOrFail($id);
			$filename = $this->imageUpload($request,  @$advertise->content->image);
			$notification = 'Advertise updated successfully';
		}
		$data = [
			'image'=>$filename,
			'link'=>$request->type == 'banner' ? $request->link : null,
			'script'=>$request->type == 'script' ? $request->script : null,
		];
		
		$advertise->title   = $request->title;
		$advertise->content = $data;
		$advertise->type    = $request->type;
		$advertise->save();		

        $notify[] = ['success',$notification];
        return back()->withNotify($notify);
	}

	public function remove($id)
	{
		$ads = Advertise::findOrFail($id);
		fileManager()->removeFile(getFilePath('ads').@$ads->content->image);
    	$ads->delete();
    	$notify[] = ['success','Advertise deleted successfully'];
    	return back()->withNotify($notify);
	}
	
	private function imageUpload($request, $oldImage = null)
	{
		$file = $request->image;
		$filename = $oldImage;
		if ($request->hasFile('image')) {
    		try {
                if ($file->getClientOriginalExtension() == 'gif'){
                    $filename = fileUploader($file, getFilePath('ads'), null, $oldImage);
                }else{
					$filename = fileUploader($file, getFilePath('ads'), '728x90', $oldImage);
                }
    		} catch (\Exception $e) {
    			$notify[] = ['error','Image Could not uploaded'];
    			return back()->withNotify($notify);
    		}
        }

		return $filename;
	}
	
}
