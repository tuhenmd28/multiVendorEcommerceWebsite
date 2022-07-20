@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">settings</h3>
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
      <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Admin Details</h4>
                
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
                  <form class="forms-sample" method="POST" action="{{ url('/admin/update-admin-details') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label >Username Or Email</label>
                      <input  class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                    </div>
                    <div class="form-group">
                      <label > Admin Type</label>
                      <input value="{{ Auth::guard('admin')->user()->type }}" readonly class="form-control" >
                    </div>
                    <div class="form-group">
                      <label for="Admin-name">Name</label>
                      <input type="text" value="{{ Auth::guard('admin')->user()->name }}" name="admin-name" class="form-control" id="Admin-name" placeholder="Enter your name" required>
                      
                    </div>
                    <div class="form-group">
                      <label for="admin-number">Mobile Number</label>
                      <input type="text" value="{{ Auth::guard('admin')->user()->mobile }}" name="admin-number" class="form-control" id="Admin-number" placeholder="Enter your mobile number" min="11" max="15">
                    </div>
                    <div class="form-group">
                      <label for="admin-image">Add Image</label>
                      <input type="file"  name="admin-image" class="form-control" id="admin-image" >
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
           
 
@include('admin.layout.footer')
</div>
</div>
@endsection