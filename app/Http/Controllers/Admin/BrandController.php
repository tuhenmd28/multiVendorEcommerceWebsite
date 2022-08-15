<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Image;
use App\Models\Brand;
use File;
class BrandController extends Controller
{
    public function brand()
    {
        Session::put('page', 'brands');
        $brands = Brand::get()->toArray();
        // dd($section);
        return view('admin.brands.brands')->with(compact('brands'));
    }
    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
    public function deleteBrand($id)
    {
        if (!empty(Brand::where("id",$id)->value('image'))) {
            $path = 'admin/images/brands/' . Brand::where("id",$id)->value('image');
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $brand = Brand::where('id', $id)->delete();
        $message = "Brand has been deleted successfully !";
        return redirect()->back()->with("success_message", $message);
    }

    public function editBrand(Request $request, $id = null)
    {
        Session::put('page', 'brands');

        if ($id == null) {
            $brand = new Brand;
            $title = "Add new Brand ";
            $message = "Brand added successfully!";
        } else {
            $brand = Brand::find($id);
            $title = "Edit Brand ";
            $message = "Brand updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                "brand-name" => "required|regex:/^[\pL\s\-]+$/u",
            ];
            $customMessage = [
                'brand-name.required' => 'brand name is required',
                'brand-name.regex' => 'Valid brand name is required',
            ];
            $this->validate($request, $rules, $customMessage);
            // update brand image
            // dd(Brand::where("id",$id)->value('image'));
            if ($request->hasFile('brand-image')) {
                $imageTmp = $request->file('brand-image');
                if ($imageTmp->isValid()) {
                    $extention = $imageTmp->getClientOriginalExtension();
                    $imageName = time() . "." . $extention;
                    $imagePath = 'admin/images/brands/' . $imageName;
                    Image::make($imageTmp)->resize(100, null, function($constraint) {
                        $constraint->aspectRatio();
                    })->save($imagePath);
                    $brand->image = $imageName;
                }
                if (!empty(Brand::where("id",$id)->value('image'))) {
                    $path = 'admin/images/brands/' . Brand::where("id",$id)->value('image');
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            } else if (!empty($data['currentImage'])) {
                $brand->image = $data['currentImage'];
            } else {
                $brand->image = '';
            }
            $brand->name = $data['brand-name'];
            $brand->status = 1;
            $brand->save();
            return redirect('admin/brands')->with('success_message',$message);
        }
        return view('admin.brands.add_edit_brand')->with(compact('title', 'message', 'brand'));
    }
}
