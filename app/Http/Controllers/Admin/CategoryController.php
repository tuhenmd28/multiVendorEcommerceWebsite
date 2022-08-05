<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Session;
use Image;
class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'categories');
        $categories = Category::with('section', 'parentCategory')->get()->toArray();
        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }
    public function editCategory(Request $request, $id = null)
    {
        Session::put('page', 'categories');

        if ($id == null) {
            $title = 'Add new Category';
            $message = "Category added successfully!";
            $category = new Category;
            $categories = array();
        } else {
            $title = 'Edit Category';
            $message = "Category Updated successfully!";
            $category = Category::find($id);
            $categories = Category::with('subCategories')->where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
            
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            // $rules = [
            //     "category_name" => "required|regex:/^[\pL\s\-]+$/u",
            //     "vendorAddress" => "required",
            //     "vendorCity" => "required",
            //     "vendorState" => "required",
            //     "vendorCountry" => "required",
            //     "vendorPincode" => "required|numeric",
            //     "vendorMobile" => "required|numeric",
            // ];
            // $customMessage = [
            //     'category_name.required' => 'Name is required',
            //     'category_name.regex' => 'Valid name is required',
            //     'vendorMobile.required' => 'Mobile is required',
            //     'vendorAddress.required' => 'Address is required',
            //     'vendorCity.required' => 'City is required',
            //     'vendorState.required' => 'State is required',
            //     'vendorCountry.required' => 'Country is required',
            //     'vendorPincode.required' => 'Pincode is required',
            //     'vendorMobile.numeric' => 'valid mobile is required',
            //     'vendorPincode.numeric' => 'valid Pincode is required',
            // ];
            // $this->validate($request, $rules, $customMessage);

            if ($request->hasFile('category_image')) {
                $imageTmp = $request->file('category_image');
                if ($imageTmp->isValid()) {
                    $extention = $imageTmp->getClientOriginalExtension();
                    $imageName = time() . "." . $extention;
                    $imagePath = 'fontend/images/category_images/' . $imageName;
                    Image::make($imageTmp)->resize(40,40)->save($imagePath);
                    $category->category_image = $imageName;
                }
                // if (!empty(Category::get()->value('category_image'))) {
                //     $path = 'fontend/images/category_images/'.Category::get()->value('category_image');
                //     if (File::exists($path)) {
                //         File::delete($path);
                //     }
                // }
            }else {
                $category->category_image = '';
            }

            $category->category_name = $data['category_name'];
            $category->section_id = $data['section_id'];
            $category->parent_id = $data['parent_id'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['category_description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_descriptin = $data['meta_descriptin'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            return redirect('admin/categories')->with('success_message',$message);
        }
        $getSection = Section::get()->toArray();
        // dd($getSection);
        return view('admin.categories.add_edit_category')->with(compact('title', 'categories', 'category', 'getSection'));
    }
    
    public function appendCategoryLavel(Request $request){

        if($request->ajax()){
            $data = $request->all();
            $categories = Category::with('subCategories')->where(['parent_id'=>0,'section_id'=>$data['section_id']])->get()->toArray();
            return view('admin.categories.append_categories_lavel')->with(compact('categories'));
        }

    }
}
