<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\AddProductImage;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\ProductAttribute;
use Session;
use Image;
use File;
class ProductsController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');

        $products = Product::with(['section'=>function($query){
            $query->select('id','name');
        },'categories'=>function($query){
            $query->select('id','category_name');
        }])->get()->toArray();
        // return $products;
        return view('admin.products.products')->with(compact('products'));
    }
    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }
    public function deleteProduct($id)
    {
        if (!empty(Product::where("id",$id)->value('product_image'))) {
            $path = 'admin/images/Products/' . Product::where("id",$id)->value('product_image');
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $product = Product::where('id', $id)->delete();
        $message = "Product has been deleted successfully !";
        return redirect()->back()->with("success_message", $message);
    }
    public function addEditProduct(Request $request, $id = null)
    {
        Session::put('page', 'products');
        if ($id == null) {
            $title = "Add New Product";
            $product = new Product;
            $message = 'Product added successfully !';
        }else{
            $title = "Update Product";
            $product = Product::find($id);
            // dd($product['category_id']);
            $message = 'Product updated successfully !';
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data); die;
            $rules = [
                "category_id" => "required",
                "product_name" => "required|regex:/^[\pL\s\-]+$/u",
                "product_code" => "required|regex:/^[\w-]*$/",
                "product_color" => "required",
                "product_price" => "required|numeric",
                // "url" => "required",
            ];
            $customMessage = [
                'category_id.required' => 'Category id is required',
                'product_name.required' => ' Product name is required',
                'product_name.regex' => 'Valid Product name is required',
                'product_code.regex' => 'Valid Product code is required',
                'product_code.required' => ' Product code is required',
                'product_color.required' => ' Product color is required',
                'product_price.required' => ' Product price is required',
                'product_price.numeric' => ' Product price must be number required',

            ];
            $this->validate($request, $rules, $customMessage);
            // upload product image after resize
            if($request->hasFile('product_image')){
                $imageTemp = $request->file('product_image');
                if($imageTemp->isValid()){
                    $imageExtention = $imageTemp->getClientOriginalExtension();
                    $imageName = time().'.'.$imageExtention;
                    $largeImagePath = 'fontend/images/product_images/large/'.$imageName;
                    $mediumImagePath = 'fontend/images/product_images/medium/'.$imageName;
                    $smallImagePath = 'fontend/images/product_images/small/'.$imageName;
                    Image::make($imageTemp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($imageTemp)->resize(500,500)->save($mediumImagePath);
                    Image::make($imageTemp)->resize(250,250)->save($smallImagePath);
                    if(!empty($product['product_image'])){
                        $path1 = 'fontend/images/product_images/large/'.$product['product_image'];
                        $path2 = 'fontend/images/product_images/medium/'.$product['product_image'];
                        $path3 = 'fontend/images/product_images/small/'.$product['product_image'];
                        if(File::exists($path1) || File::exists($path2)|| File::exists($path3)){
                            File::delete($path1);
                            File::delete($path2);
                            File::delete($path3);
                        }
                    }
                    $product->product_image = $imageName;
                }
            }else{
                $product->product_image = $request['currentproductImage'];
            }
            // upload product video
            if($request->hasFile('product_video')){
                $videoTemp = $request->file('product_video');
                if($videoTemp->isValid()){
                    // $vOrginalName = $videoTemp->getClientOriginalName();
                    $orignalExt = $videoTemp->getClientOriginalExtension();
                    $videoName = time().'.'.$orignalExt;
                    $videoPath = 'fontend/videos/product_video/';
                    $videoTemp->move($videoPath,$videoName);
                    if(!empty($product['product_video'])){
                        $path = 'fontend/videos/product_video/'.$product['product_video'];
                        if(File::exists($path)){
                            File::delete($path);
                        }
                    }
                    $product->product_video = $videoName;
                }
            }
            // seve product data in product table
            $catagoryDetails = Category::find($data['category_id']);
            $product->section_id = $catagoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $admintype = Auth::guard('admin')->user()->type;
            $adminid = Auth::guard('admin')->user()->id;
            $vendorid = Auth::guard('admin')->user()->vendor_id;
            $product->admin_type = $admintype;
            $product->admin_id = $adminid;
            if($admintype == 'vendor'){
                $product->vendor_id = $vendorid;
            }else{
                $product->vendor_id = 0;
            }
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keyword = $data['meta_keyword'];
            if(!empty($data['is_featured'])){
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = 'No';
            }
            $product->status = 1;
            $product->save();
            return redirect('admin/products')->with('success_message',$message);
        }
        // get section, category and subcategory
        $categories = Section::with('categories')->get()->toArray();
        // get brand
        $brands = Brand::get()->toArray();
        return view('admin/products/add_edit_product')->with(compact('title','product','categories','brands'));
    }
    public function deleteProductImage($id)
    {
       $productImage = Product::select('product_image')->where('id',$id)->first() ;
       $smallImagePath = 'fontend/images/product_images/small/';
       $mediumImagePath = 'fontend/images/product_images/medium/';
       $largeImagePath = 'fontend/images/product_images/large/';
      // delete small product image
       if($smallImagePath.$productImage->product_image){
        unlink($smallImagePath.$productImage->product_image);
       }
      // delete medium product image
       if($mediumImagePath.$productImage->product_image){
        unlink($mediumImagePath.$productImage->product_image);
       }
      // delete large product image
       if($largeImagePath.$productImage->product_image){
        unlink($largeImagePath.$productImage->product_image);
       }
       Product::where('id',$id)->update(['product_image'=>'']);
       $message = 'Product image has been deleted successfully !';
       return redirect()->back()->with('success_message',$message);
    }
    public function deleteProductVideo($id)
    {
       $productImage = Product::select('product_video')->where('id',$id)->first() ;
       $imagePath = 'fontend/videos/product_video/';
       if($imagePath.$productImage->product_video){
        unlink($imagePath.$productImage->product_video);
       }
       Product::where('id',$id)->update(['product_video'=>'']);
       $message = 'Product video has been deleted successfully !';
       return redirect()->back()->with('success_message',$message);
    }
    // add attributes
    public function addAttributes(Request $request,$id)
    {
        Session::put('page','products');
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('attributes')->find($id);
        // return $product;
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);
            foreach($data['SKU'] as $key=>$value){
                $skucount = ProductAttribute::where('SKU',$value)->count();
                $sizecount = ProductAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                if($skucount>0){
                    return redirect()->back()->with('error_message','SKU alreay exsist ! please add new sku');
                }
                if($sizecount>0){
                    return redirect()->back()->with('error_message','size alreay exsist ! please add new size');
                }
                if(!empty($value)){
                    $product = new ProductAttribute;
                    $product->product_id = $id;
                    $product->SKU = $value;
                    $product->size = $data['size'][$key];
                    $product->price = $data['price'][$key];
                    $product->stock = $data['stock'][$key];
                    $product->status = 1;
                    $product->save();
                }
            }
            return redirect()->back()->with('success_message','Product attributes has been added successfully !');
        }
        return view('admin.attributes.add_edit_attributes')->with(compact('product'));
    }
    public function updateProductAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['attribute_id']]);
        }
    }
    public function editAttribute(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['attributeId'] as $key=>$attribute){
                // dd($data['attribute_id'][$key]);
                if(!empty($attribute)){
                    ProductAttribute::where('id',$data['attributeId'][$key])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_message','Attribute update successfully !');
        }
    }
    public function addImage($id,Request $request)
    {
        Session::put('page','products');
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('images')->find($id);
        // return $product;
        if($request->isMethod('post')){
          $data = $request->all();
            if($request->hasFile('images')){
               $images = $request->file('images');
                // $images = $request['images'];
                foreach($images as $key=>$image){
                    // genaret image temp
                    $imageTemp = Image::make($image);
                    // get image name
                    $imageName = $image->getClientOriginalName();
                    $imageExtention = $image->getClientOriginalExtension();
                    $imageName =$imageName.time().'.'.$imageExtention;
                    $largeImagePath = 'fontend/images/product_images/large/'.$imageName;
                    $mediumImagePath = 'fontend/images/product_images/medium/'.$imageName;
                    $smallImagePath = 'fontend/images/product_images/small/'.$imageName;
                    Image::make($imageTemp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($imageTemp)->resize(500,500)->save($mediumImagePath);
                    Image::make($imageTemp)->resize(250,250)->save($smallImagePath);
                    $imageTable = new AddProductImage;
                    $imageTable->image = $imageName;
                    $imageTable->product_id = $id;
                    $imageTable->status = 1;
                    $imageTable->save();
                }
            }
            return redirect()->back()->with('success_message','Product images has been added successfully');
        }
        return view('admin.images.add_edit_images')->with(compact('product'));
    }
    public function updateProductImageStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
            AddProductImage::where('id', $data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }
    public function deleteImage($id)
    {
        $productImage = AddProductImage::select('image')->where('id',$id)->first() ;
       $smallImagePath = 'fontend/images/product_images/small/';
       $mediumImagePath = 'fontend/images/product_images/medium/';
       $largeImagePath = 'fontend/images/product_images/large/';
      // delete small product image
       if($smallImagePath.$productImage->image){
        unlink($smallImagePath.$productImage->image);
       }
      // delete medium product image
       if($mediumImagePath.$productImage->image){
        unlink($mediumImagePath.$productImage->image);
       }
      // delete large product image
       if($largeImagePath.$productImage->image){
        unlink($largeImagePath.$productImage->image);
       }
       AddProductImage::where('id',$id)->delete();
       $message = 'Product image has been deleted successfully !';
       return redirect()->back()->with('success_message',$message);
    }
}
