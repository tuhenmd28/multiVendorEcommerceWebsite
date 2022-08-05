@extends('admin.layout.layout')
@section('content') 
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Update Vendor Detaisls</h3>
              {{-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> --}}
            </div>
            <div class="col-12 col-xl-4">
             <div class="justify-content-end d-flex">
              <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                 <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                  <a class="dropdown-item" href="#">January - March</a>
                  <a class="dropdown-item" href="#">March - June</a>
                  <a class="dropdown-item" href="#">June - August</a>
                  <a class="dropdown-item" href="#">August - November</a>
                </div>
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>
      @if ($slug == 'personal')
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Update personal Details</h4>
            
              @if (Session::has('success_message'))
              <div class="alert  alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>success!</strong> {{ Session::get('success_message') }}
              </div>
              @endif
              @if (Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> {{ Session::get('error_message') }}
              </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
              </div>
              @endif
              <form class="forms-sample" method="POST" action="{{ url('/admin/update-vendor-details/personal') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label >Vendor Username Or Email</label>
                  <input  class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                </div>
                <div class="form-group">
                  <label for="vendor-name">Name</label>
                  <input type="text" value="{{ Auth::guard('admin')->user()->name }}" name="vendorName" class="form-control" id="vendorName" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                  <label for="vendorAddress">Address</label>
                  <input type="text" value="{{ $vendorDetails['address'] }}" name="vendorAddress" class="form-control" id="vendorAddress" placeholder="Enter your address" required>
                </div>
                <div class="form-group">
                  <label for="vendorCity">City</label>
                  <input type="text" value="{{ $vendorDetails['city'] }}" name="vendorCity" class="form-control" id="vendorCity" placeholder="Enter your city" required>
                </div>
                <div class="form-group">
                  <label for="vendorState">State</label>
                  <input type="text" value="{{ $vendorDetails['state'] }}" name="vendorState" class="form-control" id="vendorState" placeholder="Enter your state" required>
                </div>
                <div class="form-group">
                  <label for="vendorCountry">Counrty</label>
                  {{-- <input type="text" value="{{ $vendorDetails['country'] }}" name="vendorCountry" class="form-control" id="vendorCountry" placeholder="Enter your country" required> --}}
                  <select style="color: #000;" name="vendorCountry" id="vendorCountry" class="form-control">
                    <option value="">select country</option>
                    @foreach ($countres as $country)
                      <option @if ($country['country_name']== $vendorDetails['country'] )
                          selected
                      @endif value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>  
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="vendorPincode">Pin Code</label>
                  <input type="text" value="{{ $vendorDetails['pincode'] }}" name="vendorPincode" class="form-control" id="vendorPincode" placeholder="Enter pin code" required>
                </div>
                <div class="form-group">
                  <label for="vendorMobile">Mobile Number</label>
                  <input type="text" value="{{ Auth::guard('admin')->user()->mobile }}" name="vendorMobile" class="form-control" id="vendorMobile" placeholder="Enter your mobile number" min="11" max="15">
                </div>
                <div class="form-group">
                  <label for="vendorImage"> Photo</label>
                  <input type="file"  name="vendorImage" class="form-control" id="vendorImage" >
                  @if (!empty(Auth::guard('admin')->user()->image))
                      <a target="_blank" class="my-3 d-inline-block" href="{{ url('admin/images/uploads/'.Auth::guard('admin')->user()->image) }}">View image</a>
                  <input type="hidden" name="currentImage" value="{{ Auth::guard('admin')->user()->image }}">
                  @endif
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
 </div>
      @elseif($slug == 'business')
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Update Business Details</h4>
            
              @if (Session::has('success_message'))
              <div class="alert  alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>success!</strong> {{ Session::get('success_message') }}
              </div>
              @endif
              @if (Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> {{ Session::get('error_message') }}
              </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
              </div>
              @endif
              <form class="forms-sample" method="POST" action="{{ url('/admin/update-vendor-details/business') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label >Vendor Username Or Email</label>
                  <input  class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                </div>
                <div class="form-group">
                  <label for="shop-name">Shop Name</label>
                  <input type="text" value="{{ $vendorDetails['shop_name'] }}" name="shop_name" class="form-control" id="shop-name" placeholder="Enter Shop name" required>
                </div>
             
                <div class="form-group">
                  <label for="shop_address">Shop Address</label>
                  <input type="text" value="{{ $vendorDetails['shop_address'] }}" name="shop_address" class="form-control" id="shop_address" placeholder="Enter shop address" required>
                </div>
                <div class="form-group">
                  <label for="shopCity">Shop City</label>
                  <input type="text" value="{{ $vendorDetails['shop_city'] }}" name="shop_city" class="form-control" id="shopCity" placeholder="Enter Shop city" required>
                </div>
                <div class="form-group">
                  <label for="shopState"> Shop State</label>
                  <input type="text" value="{{ $vendorDetails['shop_state'] }}" name="shop_state" class="form-control" id="shopState" placeholder="Enter Shop state" required>
                </div>
                <div class="form-group">
                  <label for="shopCountry">Shop Counrty</label>
                  {{-- <input type="text" value="{{ $vendorDetails['shop_country'] }}" name="shop_country" class="form-control" id="shopCountry" placeholder="Enter Shop country" required> --}}
                  <select name="shop_country" id="shop_country" class="form-control " style="color:#000;">
                    <option value="">select country</option>
                    @foreach ($countres as $country)
                      <option @if ($country['country_name']== $vendorDetails['shop_country'] )
                          selected
                      @endif value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>  
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="shopPincode">Shop Pin Code</label>
                  <input type="text" value="{{ $vendorDetails['shop_pincode'] }}" name="shop_pincode" class="form-control" id="shopPincode" placeholder="Enter Shop pin code" required>
                </div>
                <div class="form-group">
                  <label for="business_license_number">Business License Number</label>
                  <input type="text" value="{{ $vendorDetails['business_license_number'] }}" name="business_license_number" class="form-control" id="business_license_number" placeholder="Enter Shop pin code" required>
                </div>
                <div class="form-group">
                  <label for="gst_number">Shop GST Number</label>
                  <input type="text" value="{{ $vendorDetails['gst_number'] }}" name="gst_number" class="form-control" id="gst_number" placeholder="Enter Shop pin code" required>
                </div>
                <div class="form-group">
                  <label for="	pan_number">Shop Pan Number</label>
                  <input type="text" value="{{ $vendorDetails['pan_number'] }}" name="pan_number" class="form-control" id="pan_number" placeholder="Enter Shop pin code" required>
                </div>
                <div class="form-group">
                  <label for="	shop_website">Shop Website</label>
                  <input type="text" value="{{ $vendorDetails['shop_website'] }}" name="shop_website" class="form-control" id="	shop_website" placeholder="Enter Shop pin code" required>
                </div>
                <div class="form-group">
                  <label for="shopMobile">Shop Mobile Number</label>
                  <input type="text" value="{{ $vendorDetails['shop_mobile'] }}" name="shop_mobile" class="form-control" id="shopMobile" placeholder="Enter Shop mobile number" min="11" max="15">
                </div>
                <div class="form-group">
                  <label for="address-proof">Address Proof</label>
                  <select name="address_proof" style="color: #000;" id="address-proof" class="form-control">
                    <option value="Passport" @if($vendorDetails['address_proof'] == 'Passport') selected @endif>Passport</option>
                    <option value="NID Card"  @if($vendorDetails['address_proof'] == 'NID Card') selected @endif>NID Card</option>
                    <option value="Driving License" @if($vendorDetails['address_proof'] == 'Driving License') selected @endif>Driving License</option>
                    <option value="PAN" @if($vendorDetails['address_proof'] == 'PAN') selected @endif>PAN</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="address_proof_image">Address Proof Photo</label>
                  <input type="file"  name="address_proof_image" class="form-control" id="address_proof_image" >
                  @if (!empty($vendorDetails['address_proof_image']))
                      <a target="_blank" class="my-3 d-inline-block" href="{{ url('admin/images/proof/'.$vendorDetails['address_proof_image']) }}">View image</a>
                  <input type="hidden" name="current_address_proof_image" value="{{ $vendorDetails['address_proof_image'] }}">
                  @endif 
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
 </div>

      @elseif($slug == 'bank')
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Update Bank Details</h4>
            
              @if (Session::has('success_message'))
              <div class="alert  alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>success!</strong> {{ Session::get('success_message') }}
              </div>
              @endif
              @if (Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> {{ Session::get('error_message') }}
              </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
              </div>
              @endif
              <form class="forms-sample" method="POST" action="{{ url('admin/update-vendor-details/bank') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label >Username Or Email</label>
                  <input  class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                </div>
                <div class="form-group">
                  <label for="account_holder_name">Account holder Name</label>
                  <input type="text" value="{{ $vendorDetails['account_holder_name']}}" name="account_holder_name" class="form-control" id="account_holder_name" placeholder="Enter your account holser name">
                  
                </div>
                <div class="form-group">
                  <label for="bank_name">Bank name</label>
                  <input type="text" value="{{ $vendorDetails['bank_name']}}" name="bank_name" class="form-control" id="bank_name" placeholder="Enter your Bank name" >
                </div>
                <div class="form-group">
                  <label for="account_number">Account number</label>
                  <input type="text" value="{{ $vendorDetails['account_number']}}" name="account_number" class="form-control" id="account_number" placeholder="Enter your account number" >
                </div>
                <div class="form-group">
                  <label for="bank_ifsc_code">Bank IFSC code</label>
                  <input type="text" value="{{ $vendorDetails['bank_ifsc_code']}}" name="bank_ifsc_code" class="form-control" id="bank_ifsc_code" placeholder="Enter your Bank IFSC code" >
                </div>
            
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
 </div>
      @endif
      
           
 
@include('admin.layout.footer')
</div>
</div>
@endsection