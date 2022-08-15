<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use App\Models\VendorsBankDetail;
use App\Models\Country;
use DB;
use File;
use Image;
use Illuminate\Support\Facades\Hash;
use Session;

class AdminController extends Controller
{
    public function index()
    {
        Session::put('page','dashboard');
        return view('admin/dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email' => 'required|email|max:50',
                'password' => 'required',
            ]);
            $data = $request->all();

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid email or password');
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
        Session::put('page','UpdateAdminPassword');

        if ($request->isMethod('post')) {
            $data = $request->all();
            // check if current password admin is correct
            if (Hash::check($data['currentPassword'], Auth::guard('admin')->user()->password)) {
                // check and update admin password
                if ($data['newpassword'] === $data['confirm_password']) {

                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['newpassword'])]);
                    return redirect()->back()->with('success_message', 'Your New Password has been update successfully');
                } else {

                    return redirect()->back()->with('error_message', 'New password or confirm password does not match !');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your Current Password is Incorrect');
            }
        }

        $userDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view("admin.setting.update-admin-password", compact('userDetails'));
    }
    public function UpdateAdminDetails(Request $request)
    {
        Session::put('page','UpdateAdminDetails');

        if ($request->isMethod('post')) {
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
            $this->validate($request, $rules, $customMessage);
            // update admin image
            if ($request->hasFile('admin-image')) {
                $imageTmp = $request->file('admin-image');
                if ($imageTmp->isValid()) {
                    $extention = $imageTmp->getClientOriginalExtension();
                    $imageName = time() . "." . $extention;
                    $imagePath = 'admin/images/uploads/' . $imageName;
                    Image::make($imageTmp)->resize(200, 200)->save($imagePath);
                }
                if (!empty(Auth::guard('admin')->user()->image)) {
                    $path = 'admin/images/uploads/' . Auth::guard('admin')->user()->image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            } else if (!empty($data['currentImage'])) {
                $imageName = $data['currentImage'];
            } else {
                $imageName = '';
            }
            // update admin details
            Admin::where('id', Auth::guard('admin')->user()->id)->update(["name" => $data['admin-name'], "mobile" => $data['admin-number'], "image" => $imageName]);
            return redirect()->back()->with("success_message", "Admin details update successfully");
        }
        return view('admin.setting.update-admin-details');
    }
    public function checkPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r(Auth::guard('admin')->user()->password);die;
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return 'true';
        } else {
            return 'false';
        }
    }
    public function updateVendorDetails($slug, Request $request)
    {
        if ($slug == 'personal') {
        Session::put('page','personal');

            if ($request->isMethod('post')) {
                $data = $request->all();
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
                $this->validate($request, $rules, $customMessage);
                // update admin image
                if ($request->hasFile('vendorImage')) {
                    $imageTmp = $request->file('vendorImage');
                    if ($imageTmp->isValid()) {
                        $extention = $imageTmp->getClientOriginalExtension();
                        $imageName = time() . "." . $extention;
                        $imagePath = 'admin/images/uploads/' . $imageName;
                        Image::make($imageTmp)->resize(200, 200)->save($imagePath);
                    }
                    if (!empty(Auth::guard('admin')->user()->image)) {
                        $path = 'admin/images/uploads/' . Auth::guard('admin')->user()->image;
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                    }
                } else if (!empty($data['currentImage'])) {
                    $imageName = $data['currentImage'];
                } else {
                    $imageName = '';
                }
                // update in Admin table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(["name" => $data['vendorName'], "mobile" => $data['vendorMobile'], "image" => $imageName]);

                // update in Vender table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(["name" => $data['vendorName'], "address" => $data['vendorAddress'], "city" => $data['vendorCity'], "state" => $data['vendorState'], "country" => $data['vendorCountry'], "pincode" => $data['vendorPincode'], "mobile" => $data['vendorMobile']]);

                return redirect()->back()->with("success_message", "Vendor details update successfully");
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if ($slug == "business") {
           Session::put('page','business');

            $getId = Auth::guard('admin')->user()->vendor_id;
            $getImg = VendorsBusinessDetail::find($getId)->value('address_proof_image');
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    "shop_name" => "required|regex:/^[\pL\s\-]+$/u",
                    "shop_address" => "required",
                    "shop_city" => "required",
                    "shop_state" => "required",
                    "shop_country" => "required",
                    "shop_pincode" => "required|numeric",
                    "shop_mobile" => "required|numeric",
                ];
                $customMessage = [
                    'shop_name.required' => 'Name is required',
                    'shop_name.regex' => 'Valid name is required',
                    'shop_mobile.required' => 'Mobile is required',
                    'shop_address.required' => 'Address is required',
                    'shop_city.required' => 'City is required',
                    'shop_state.required' => 'State is required',
                    'shop_country.required' => 'Country is required',
                    'shop_pincode.required' => 'Pincode is required',
                    'shop_mobile.numeric' => 'shop mobile is required',
                    'shop_pincode.numeric' => 'shop Pincode is required',

                ];
                $this->validate($request, $rules, $customMessage);
                // update admin image
                if ($request->hasFile('address_proof_image')) {
                    $imageTmp = $request->file('address_proof_image');
                    if ($imageTmp->isValid()) {
                        $extention = $imageTmp->getClientOriginalExtension();
                        $imageName = time() . "." . $extention;
                        $imagePath = 'admin/images/proof/'.$imageName;
                        Image::make($imageTmp)->save($imagePath);
                    }
                    if (!empty($getImg)) {
                        $path = 'admin/images/proof/'.$getImg;
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                    }
                } else if (!empty($data['current_Address-Proof-Image'])) {
                    $imageName = $data['current_Address-Proof-Image'];
                } else {
                    $imageName = '';
                }


            // update in vendors_business_details table
            VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                "shop_name" => $data['shop_name'],
                "shop_address" => $data['shop_address'],
                "shop_city" => $data['shop_city'],
                "shop_state" => $data['shop_state'],
                "shop_country" => $data['shop_country'],
                "shop_pincode" => $data['shop_pincode'],
                "shop_mobile" => $data['shop_mobile'],
                "shop_website" => $data['shop_website'],
                "address_proof" => $data['address_proof'],"address_proof_image" => $imageName,
                "address_proof" => $data['address_proof'],
                "business_license_number" => $data['business_license_number'],
                "gst_number" => $data['gst_number'],
                "pan_number" => $data['pan_number'],

            ]);

                return redirect()->back()->with("success_message", "Vendor details update successfully");
            }
            $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            // echo "<pre>";print_r($vendorDetails);
        } else if ($slug == 'bank') {
        Session::put('page','bank');
            if ($request->isMethod("post")) {
                $data = $request->all();
                $rules = [
                    "account_holder_name" => "required|regex:/^[\pL\s\-]+$/u",
                    "bank_name" => "required|regex:/^[\pL\s\-]+$/u",
                    "account_number" => "required|numeric",
                    "bank_ifsc_code" => "required|numeric",
                ];
                $customMessage = [
                    'account_holder_name.required' => 'Account holder name is required',
                    'account_holder_name.regex' => 'Valid Account holder is required',
                    'bank_name.required' => 'Babk Name is required',
                    'bank_name.regex' => 'Valid Bank name is required',
                    'bank_ifsc_code.required' => 'Bank ifsc code is required',
                    'account_number.required' => 'Account number is required',
                    'account_number.numeric' => 'valid account number is required',
                    'bank_ifsc_code.numeric' => 'valid Bank ifsc code is required',
                ];
                $this->validate($request, $rules, $customMessage);
                // update in vendors_bank_details table
                VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                    'account_holder_name' => $data['account_holder_name'],
                    'bank_name' => $data['bank_name'],
                    'account_number' => $data['account_number'],
                    'bank_ifsc_code' => $data['bank_ifsc_code'],
                ]);
                return redirect()->back()->with("success_message", "Vendor bank details update successfully");
            }

            $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

        }
       $countres = Country::where('status',1)->get()->toArray();

        return view('admin.setting.update-vendor-details', compact('slug', 'vendorDetails','countres'));
    }
    public function admins($type = null)
    {
        $admins = Admin::query();
        if(!empty($type)){
            $admins = $admins->where('type',$type);
            Session::put('page','view_'.strtolower($type));
            $type = ucfirst($type).'s';
        }else{
            $type = 'All Admins/Subadmins/vendors';
        Session::put('page','view_all');
        }
        $admins = $admins->get()->toArray();
        return view('admin.admins.admins')->with(compact('admins','type'));
    }
    public function viewVendorDetails($id)
    {
        Session::put('page', 'view_vendor');
       $vendor = Admin::with("viewPorsonal","viewBusiness","viewBank")->where('id',$id)->first();
       $vendor = json_decode(json_encode($vendor),true);
       return view('admin.admins.view-vendor-details')->with(compact('vendor'));
    }
    public function updateAdminStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == 'active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Admin::where('id',$data['adminid'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'admin-id'=>$data['adminid']]);
        }
    }
}
