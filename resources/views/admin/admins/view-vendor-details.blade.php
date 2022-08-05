@extends('admin.layout.layout')
@section('content') 
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold"> Vendor Detaisls</h3>
              <h4 class="font-weight-bold"> <a href="{{ url('admin/admins/vendor') }}">Back to vendor</a></h4>
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
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> personal Details</h4>
            
                <div class="form-group">
                  <label >Vendor Username Or Email</label>
                  <input  class="form-control" value="{{ $vendor['view_porsonal']['email'] }}" readonly >
                </div>
               
                <div class="form-group">
                  <label for="vendor-name">Name</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_porsonal']['name'] }}" readonly >
                </div>
                <div class="form-group">
                  <label for="vendorAddress">Address</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_porsonal']['address'] }}" readonly >
                </div>
                <div class="form-group">
                  <label for="vendorCity">City</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_porsonal']['city'] }}" readonly>
                </div>
                <div class="form-group">
                  <label for="vendorState">State</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_porsonal']['state'] }}" readonly>
                </div>
                <div class="form-group">
                  <label for="vendorCountry">Counrty</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_porsonal']['country'] }}" readonly>
                </div>
                <div class="form-group">
                  <label for="vendorPincode">Pin Code</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_porsonal']['pincode'] }}" readonly>
                </div>
                <div class="form-group">
                  <label for="vendorMobile">Mobile Number</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_porsonal']['mobile'] }}" readonly >
                </div>
                @if (!empty($vendor['image'] ))
                <div class="form-group">
                  <label for="vendorImage">Photo</label>
                  <br>
                      <img src="{{ url('admin/images/uploads/'.$vendor['image']) }}" style="width:200px;">
                  
                </div>
                @endif
            </div>
          </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Business Information</h4>
            
                <div class="form-group">
                  <label for="vendor-name">Shop name</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['shop_name'] }}" readonly >
                </div>
                <div class="form-group">
                  <label for="vendorAddress">Shop Address</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['shop_address'] }}" readonly >
                </div>
                <div class="form-group">
                  <label for="vendorCity">Shop City</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['shop_city'] }}" readonly>
                </div>
              
                <div class="form-group">
                  <label for="vendorCountry">Shop Counrty</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['shop_country'] }}" readonly>
                </div>
                <div class="form-group">
                  <label for="vendorPincode">Shop Pin Code</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['shop_pincode'] }}" readonly>
                </div>
                <div class="form-group">
                  <label for="vendorMobile">Shop Mobile Number</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['shop_mobile'] }}" readonly >
                </div>
                <div class="form-group">
                  <label >Shop Email Address</label>
                  <input  class="form-control" value="{{ $vendor['view_business']['shop_email'] }}" readonly >
                </div>
                <div class="form-group">
                  <label >Website Link</label>
                  <input  class="form-control" value="{{ $vendor['view_business']['shop_website'] }}" readonly >
                </div>
                <div class="form-group">
                  <label for="vendorState">Address Proof</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['address_proof'] }}" readonly>
                </div>
                <div class="form-group">
                  <label for="vendorMobile">Business license number</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['business_license_number'] }}" readonly >
                </div>
                <div class="form-group">
                  <label for="vendorMobile">GST Number</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['gst_number'] }}" readonly >
                </div>
                <div class="form-group">
                  <label for="vendorMobile">Pan Number</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_business']['pan_number'] }}" readonly >
                </div>
                @if (!empty($vendor['view_business']['address_proof_image'] ))
                <div class="form-group">
                  <label for="vendorImage">Photo</label>
                  <br>
                      <img src="{{ url('admin/images/proof/'.$vendor['view_business']['address_proof_image']) }}" style="width:200px;">
                  
                </div>
                @endif
            </div>
          </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Bankk Information</h4>
            
                <div class="form-group">
                  <label for="vendor-name">Account holder name</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_bank']['account_holder_name'] }}" readonly >
                </div>
                <div class="form-group">
                  <label for="vendorAddress">Bank Name</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_bank']['bank_name'] }}" readonly >
                </div>
                <div class="form-group">
                  <label for="vendorCity">Account Number</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_bank']['account_number'] }}" readonly>
                </div>
              
                <div class="form-group">
                  <label for="vendorCountry">Bank ifsc code</label>
                  <input type="text" class="form-control" value="{{ $vendor['view_bank']['bank_ifsc_code'] }}" readonly>
                </div>
            </div>
          </div>
        </div>
      </div>

      
           
 
@include('admin.layout.footer')
</div>
</div>
@endsection