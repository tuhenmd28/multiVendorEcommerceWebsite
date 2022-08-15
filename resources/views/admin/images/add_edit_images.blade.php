
@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              {{-- <h4 class="font-weight-bold">Catalogue Management</h4> --}}
              <h5 class="card-title"> Product Image</h5>
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
      <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    {{-- {{ Session::get('page') }} --}}
                  <h4 class="card-title">Add Image</h4>

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
                  <form class="forms-sample" method="POST" action="{{ url('/admin/add-edit-images/'.$product['id']) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="">Product Name</label>
                      &nbsp;&nbsp;{{ $product['product_name'] }}
                    </div>
                    <div class="form-group">
                      <label for="">Product code</label>
                      &nbsp;&nbsp;{{ $product['product_code'] }}
                    </div>
                    <div class="form-group">
                      <label for="">Product color</label>
                      &nbsp;&nbsp;{{ $product['product_color'] }}
                    </div>
                    <div class="form-group">
                      <label for="">Product price</label>
                      &nbsp;&nbsp;{{ $product['product_price'] }}
                    </div>

                    <div class="form-group">
                      <label for="category_image">Product Image</label> <br>
                      @if (!empty($product['product_image']))
                      <img style="width:120px;"   src="{{ url('fontend/images/product_images/small/'.$product['product_image']) }}" >
                      @else
                      <img style="width:120px;"   src="{{ url('fontend/images/product_images/small/no_image.png') }}" >
                     @endif

                    </div>
                    <div class="form-group">
                    <div class="field_wrapper">
                            <input required type="file" name="images[]" id="images"  multiple="multiple" >
                    </div>
                </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light" type="reset">Cancel</button>
                  </form>
                  <br><br><br>
                  <h5 class="card-title">Product Images</h5>
                  <div class="table-responsive pt-3">
                     <table id="productAttributea" class="table table-bordered text-center">
                       <thead>
                         <tr>
                           <th>Id</th>
                           <th>Image</th>
                           <th>Status</th>
                           {{-- <th>Action</th> --}}
                         </tr>
                       </thead>
                       <tbody>
                           @foreach ($product['images'] as $image)
                           <tr>
                               <td>
                                 {{ $image['id'] }}
                               </td>
                               <td>
                                <img   src="{{ url('fontend/images/product_images/small/'.$image['image']) }}" >
                               </td>

                               <td style="text-align: center;">
                                   @if ($image['status']==1)
                                   <a href="javascript:void(0)" class="updateProductimageStatus" id="image-{{ $image['id'] }}" image-id="{{ $image['id'] }}">  <i style="font-size: 25px;" class="mdi mdi-bookmark-check" status="active"></i></a>
                                   @else
                                   <a href="javascript:void(0)" class="updateProductimageStatus" id="image-{{ $image['id'] }}" image-id="{{ $image['id'] }}">
                                   <i style="font-size: 25px;" class="mdi mdi-bookmark-outline" status="inactive"></i></a>
                                   @endif
                                   <a module="image" moduleId="{{ $image['id'] }}" class="confirmDelete" href="javascript:void(0)">
                                    <i style="font-size: 25px;" class="mdi mdi-delete"></i></a>
                               </td>
                               {{-- <td>
                                   <a href="{{ url('admin/add-edit-attributes/'.$attribute['id']) }}">
                                     <i style="font-size: 25px;" class="mdi mdi-pencil-box"></i></a>

                                   <a module="product" moduleId="{{ $attribute['id'] }}" class="confirmDelete" href="javascript:void(0)">
                                     <i style="font-size: 25px;" class="mdi mdi-delete"></i></a>
                               </td> --}}
                             </tr>
                           @endforeach
                       </tbody>
                    </table>
              </div>
                </div>
              </div>
            </div>
     </div>


@include('admin.layout.footer')
</div>
</div>
@endsection
