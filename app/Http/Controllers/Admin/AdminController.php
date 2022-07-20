<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use File;
use Image;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }
    
    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $validated = $request->validate([
                'email' => 'required|email|max:50',
                'password' => 'required',
            ]);
            $data = $request->all();
            
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message','Invalid email or password');
            }
        }
        return view('admin/login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function UpdateAdminPassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // check if current password admin is correct
            if(Hash::check($data['currentPassword'], Auth::guard('admin')->user()->password)){
                // check and update admin password
                if($data['newpassword'] === $data['confirm_password']){

                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['newpassword'])]);
                    return redirect()->back()->with('success_message','Your New Password has been update successfully');
                }else{

                    return redirect()->back()->with('error_message','New password or confirm password does not match !');
                }
            }else{
                return redirect()->back()->with('error_message','Your Current Password is Incorrect');
            }
        }
 
        $userDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
       return view("admin.setting.update-admin-password",compact('userDetails'));
    }
    public function UpdateAdminDetails(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $rules = [
                "admin-name" => "required|regex:/^[\pL\s\-]+$/u",
                "admin-number" => "required|numeric"
            ];
            $customMessage = [
                'admin-name.required' => 'Name is required',
                'admin-name.regex' => 'Valid name is required',
                'admin-number.required' => 'Mobile is required',
                'admin-number.numeric' => 'valid mobile is required',
            ];
            $this->validate($request,$rules,$customMessage);
            // update admin image 
            if($request->hasFile('admin-image')){
                 $imageTmp = $request->file('admin-image');
                if($imageTmp->isValid()){
                    $extention = $imageTmp->getClientOriginalExtension();
                    $imageName = time().".".$extention;
                    $imagePath ='admin/images/uploads/'.$imageName;
                    Image::make($imageTmp)->resize(200,200)->save($imagePath);
                }
                if(!empty(Auth::guard('admin')->user()->image)){
                    $path = 'admin/images/uploads/'.Auth::guard('admin')->user()->image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                }
            }else if(!empty($data['currentImage'])){
                $imageName = $data['currentImage'];
            }else{
                $imageName = '';
            }
            // update admin details 
            Admin::where('id',Auth::guard('admin')->user()->id)->update(["name"=>$data['admin-name'],"mobile"=>$data['admin-number'],"image" => $imageName]);
            return redirect()->back()->with("success_message","Admin details update successfully");
        }
        return view('admin.setting.update-admin-details');
    }
    public function checkPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r(Auth::guard('admin')->user()->password);die;
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
            return 'true';
        }else{
            return 'false';
        }
    }
    public function updateVendorDetails($slug,Request $request)
    {
       if($slug == 'personal'){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);
            $rules = [
                "vendorName" => "required|regex:/^[\pL\s\-]+$/u",
                "vendorAddress" => "required",
                "vendorCity" => "required",
                "vendorState" => "required",
                "vendorCountry" => "required",
                "vendorPincode" => "required|numeric",
                "vendorMobile" => "required|numeric",
            ];
            $customMessage = [
                'vendorName.required' => 'Name is required',
                'vendorName.regex' => 'Valid name is required',
                'vendorMobile.required' => 'Mobile is required',
                'vendorAddress.required' => 'Address is required',
                'vendorCity.required' => 'City is required',
                'vendorState.required' => 'State is required',
                'vendorCountry.required' => 'Country is required',
                'vendorPincode.required' => 'Pincode is required',
                'vendorMobile.numeric' => 'valid mobile is required',
                'vendorPincode.numeric' => 'valid Pincode is required',
            ];
            $this->validate($request,$rules,$customMessage);
            // update admin image 
            if($request->hasFile('vendorImage')){
                 $imageTmp = $request->file('vendorImage');
                if($imageTmp->isValid()){
                    $extention = $imageTmp->getClientOriginalExtension();
                    $imageName = time().".".$extention;
                    $imagePath ='admin/images/uploads/'.$imageName;
                    Image::make($imageTmp)->resize(200,200)->save($imagePath);
                }
                if(!empty(Auth::guard('admin')->user()->image)){
                    $path = 'admin/images/uploads/'.Auth::guard('admin')->user()->image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                }
            }else if(!empty($data['currentImage'])){
                $imageName = $data['currentImage'];
            }else{
                $imageName = '';
            }
            // update in Admin table 
            Admin::where('id',Auth::guard('admin')->user()->id)->update(["name"=>$data['vendorName'],"mobile"=>$data['vendorMobile'],"image" => $imageName]);

            // update in Vender table
            Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update(["name"=>$data['vendorName'],"address"=>$data['vendorAddress'],"city"=>$data['vendorCity'],"state"=>$data['vendorState'],"country"=>$data['vendorCountry'],"pincode"=>$data['vendorPincode'],"mobile"=>$data['vendorMobile']]);

            return redirect()->back()->with("success_message","Vendor details update successfully");
            
        }
        $vendorDetails = Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();

       }else if($slug == "business"){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);
            $rules = [
                "vendorName" => "required|regex:/^[\pL\s\-]+$/u",
                "vendorAddress" => "required",
                "vendorCity" => "required",
                "vendorState" => "required",
                "vendorCountry" => "required",
                "vendorPincode" => "required|numeric",
                "vendorMobile" => "required|numeric",
            ];
            $customMessage = [
                'vendorName.required' => 'Name is required',
                'vendorName.regex' => 'Valid name is required',
                'vendorMobile.required' => 'Mobile is required',
                'vendorAddress.required' => 'Address is required',
                'vendorCity.required' => 'City is required',
                'vendorState.required' => 'State is required',
                'vendorCountry.required' => 'Country is required',
                'vendorPincode.required' => 'Pincode is required',
                'vendorMobile.numeric' => 'valid mobile is required',
                'vendorPincode.numeric' => 'valid Pincode is required',
            ];
            $this->validate($request,$rules,$customMessage);
            // update admin image 
            if($request->hasFile('vendorImage')){
                 $imageTmp = $request->file('vendorImage');
                if($imageTmp->isValid()){
                    $extention = $imageTmp->getClientOriginalExtension();
                    $imageName = time().".".$extention;
                    $imagePath ='admin/images/uploads/'.$imageName;
                    Image::make($imageTmp)->resize(200,200)->save($imagePath);
                }
                if(!empty(Auth::guard('admin')->user()->image)){
                    $path = 'admin/images/uploads/'.Auth::guard('admin')->user()->image;
                    if(File::exists($path)){
                        File::delete($path);
                    }
                }
            }else if(!empty($data['currentImage'])){
                $imageName = $data['currentImage'];
            }else{
                $imageName = '';
            }
            // update in Admin table 
            Admin::where('id',Auth::guard('admin')->user()->id)->update(["name"=>$data['vendorName'],"mobile"=>$data['vendorMobile'],"image" => $imageName]);

            // update in Vender table
            Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update(["name"=>$data['vendorName'],"address"=>$data['vendorAddress'],"city"=>$data['vendorCity'],"state"=>$data['vendorState'],"country"=>$data['vendorCountry'],"pincode"=>$data['vendorPincode'],"mobile"=>$data['vendorMobile']]);

            return redirect()->back()->with("success_message","Vendor details update successfully");
            
        }
        $vendorDetails = VendorsBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        echo "<pre>";print_r($vendorDetails);
       }else if($slug == 'bank'){

       }
       return view('admin.setting.update-vendor-details',compact('slug','vendorDetails'));
    }
}
