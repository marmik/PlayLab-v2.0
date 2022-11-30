<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class PlanController extends Controller {
    public function index() {
        $pageTitle = "Subscription Plans";
        $plans     = Plan::latest()->paginate(getPaginate());
        return view('admin.plan.index', compact('pageTitle', 'plans'));
    }

    public function store(Request $request, $id = 0) {
        $imageValidate = $id ? 'nullable' : 'required';
        $request->validate([
            'name'        => 'required|unique:plans,name,' . $id,
            'price'       => 'required|numeric|gt:0',
            'duration'    => 'required|integer|gt:0',
            'description' => 'required|string',
            'image'       => [$imageValidate, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($id == 0) {
            $plan         = new Plan();
            $notification = 'Plan created successfully';
            $oldImage     = null;
        } else {
            $plan         = Plan::findOrFail($id);
            $plan->status = $request->status ? 1 : 0;
            $notification = 'Plan updated successfully';
            $oldImage     = $plan->image;
        }

        if ($request->hasFile('image')) {
            try {
                $plan->image = fileUploader($request->image, getFilePath('plan'), getFileSize('plan'),$oldImage);
            } catch (\Exception$e) {
                $notify[] = ['error', 'Image could not be uploaded'];
                return back()->withNotify($notify);
            }

        }

        $plan->name        = $request->name;
        $plan->pricing     = $request->price;
        $plan->duration    = $request->duration;
        $plan->description = $request->description;
        $plan->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

}
