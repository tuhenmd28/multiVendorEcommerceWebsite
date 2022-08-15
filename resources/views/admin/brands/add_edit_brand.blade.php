@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Brand</h3>
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
                  <h4 class="card-title">{{ $title }}</h4>

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
                  <form class="forms-sample" method="POST"
                   @if (empty($brand['id']))
                  action="{{ url('/admin/add-edit-brand') }}"
                  @else
                  action="{{ url('/admin/add-edit-brand/'.$brand['id']) }}"
                  @endif  enctype="multipart/form-data">
                    @csrf
                    {{ $brand['name'] }}
                    <div class="form-group">
                      <label for="brand-name">Brand Name</label>
                      <input type="text" value="{{ empty($brand['name'])?'':$brand['name'] }}" name="brand-name" class="form-control" id="brand-name" placeholder="Enter brand name" required>

                    </div>
                    <div class="form-group">
                      <label for="brand-name">Brand image</label>
                      <input type="file" name="brand-image" class="form-control" id="brand-name">
                      <input type="hidden" name="currentImage" value="{{ empty($brand['image'])?'':$brand['image'] }}">
                      @if (!empty($brand['image']))
                        <a href="{{ url('admin/images/brands/'.$brand['image']) }}" target="_blank" rel="noopener noreferrer">view image</a>
                      @endif
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light" type="reset">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
     </div>


@include('admin.layout.footer')
</div>
</div>
@endsection

