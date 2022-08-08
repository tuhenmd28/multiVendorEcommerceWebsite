<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Session;
use Image;
use File;
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
            $getCategories = array();
        } else {
            $title = 'Edit Category';
            $message = "Category Updated successfully!";
            $category = Category::find($id);
            $getCategories = Category::with('subCategories')->where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            if($data['category_discount'] == ''){
                $data['category_discount']= 0;
            }
            $rules = [
                "category_name" => "required|regex:/^[\pL\s\-]+$/u",
                "section_id" => "required",
                "url" => "required",
            ];
            $customMessage = [
                'category_name.required' => 'Category name is required',
                'category_name.regex' => 'Valid category name is required',
                'section_id.required' => 'Section id is required',
                'url.required' =>  ' Category URL is required',
            ];
            $this->validate($request, $rules, $customMessage);

            if ($request->hasFile('category_image')) {
                $imageTmp = $request->file('category_image');
                if ($imageTmp->isValid()) {
                    $extention = $imageTmp->getClientOriginalExtension();
                    $imageName = time() . "." . $extention;
                    $imagePath = 'fontend/images/category_images/' . $imageName;
                    Image::make($imageTmp)->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($imagePath);
                    $category->category_image = $imageName;
                }
                if (!empty(Category::get()->value('category_image'))) {
                    $path = 'fontend/images/category_images/'.Category::get()->value('category_image');
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            }else if(!empty($data['currentCategoryImage'])){
                $category->category_image = $data['currentCategoryImage'];
            }
            else {
                $category->category_image = '';
            }

            $category->category_name = $data['category_name'];
            $category->section_id = $data['section_id'];
            $category->parent_id = $data['parent_id'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_descriptin = $data['meta_descriptin'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            return redirect('admin/categories')->with('success_message',$message);
        }
        $getSection = Section::get()->toArray();
        return view('admin.categories.add_edit_category')->with(compact('title', 'getCategories', 'category', 'getSection'));
    }
    
    public function appendCategoryLavel(Request $request){

        if($request->ajax()){
            $data = $request->all();
            $getCategories = Category::with('subCategories')->where(['parent_id'=>0,'section_id'=>$data['section_id']])->get()->toArray();
            // return $getCategories ;
            return view('admin.categories.append_categories_lavel')->with(compact('getCategories'));
        }

    }
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        $message = "Category has been deleted successfully !";
        return redirect()->back()->with("success_message", $message);
    }
    public function deleteCategoryImage($id){
        $categpryImage = Category::where('id',$id)->value('category_image');
        $path = 'fontend/images/category_images/'.$categpryImage;
        // dd($path);
        if(File::exists($path)){
            File::delete($path);
        }
        Category::where('id',$id)->update(['category_image'=>'']);
        $message = "Category image has been deleted successfully !";
        return redirect()->back()->with("success_message", $message);
    }
}
