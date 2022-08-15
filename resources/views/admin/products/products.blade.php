@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                @if (Session::has('success_message'))
                <div class="alert  alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>success!</strong> {{ Session::get('success_message') }}
                </div>
                @endif
                <h4 class="card-title">Products</h4>
                <a style="float: right;" href="{{ url('admin/add-edit-product') }}" class="btn btn-primary ">Add Product</a>
                <div class="table-responsive pt-3">
                  <table id="product" class="table table-bordered text-center">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Product Color</th>
                        <th>Product Code</th>
                        <th>Section</th>
                        <th>Category</th>
                        <th>Adder Type</th>
                        <th>Product Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                              {{ $product['id'] }}
                            </td>
                            <td>
                                {{ $product['product_name'] }}
                            </td>
                            <td>
                                {{ $product['product_color'] }}
                            </td>
                            <td>
                                {{ $product['product_code'] }}
                            </td>
                            <td>
                                {{ $product["section"]["name"] }}
                            </td>
                            <td>
                                {{ $product["categories"]["category_name"] }}
                            </td>
                            <td>
                                @if ($product['admin_type'] == 'vendor')
                                <a href="{{url('admin/view-vendor-details/'.$product['admin_id'])}}" target="_blank" >{{$product['admin_type']}}</a>
                                @else
                                {{$product['admin_type']}}
                                @endif
                            </td>
                            <td>
                                @if (!empty($product['product_image']))
                                <img style="width: 120px;height:auto;border-radius:0px;" src="{{url('fontend/images/product_images/small/'.$product['product_image'])}}" alt="">
                                @else
                                <img style="width: 120px;height:auto;border-radius:0px;" src="{{url('fontend/images/product_images/small/no_image.png')}}" alt="">
                                @endif
                                {{-- {{ $product['image'] }} --}}
                            </td>
                            <td style="text-align: center;">
                                @if ($product['status']==1)
                                <a href="javascript:void(0)" class="updateproductStatus" id="product-{{ $product['id'] }}" product-id="{{ $product['id'] }}">  <i style="font-size: 25px;" class="mdi mdi-bookmark-check" status="active"></i></a>
                                @else
                                <a href="javascript:void(0)" class="updateproductStatus" id="product-{{ $product['id'] }}" product-id="{{ $product['id'] }}">
                                <i style="font-size: 25px;" class="mdi mdi-bookmark-outline" status="inactive"></i></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/add-edit-product/'.$product['id']) }}">
                                  <i style="font-size: 25px;" class="mdi mdi-pencil-box"></i></a>

                                <a title="Add product attribute" href="{{ url('admin/add-edit-attributes/'.$product['id']) }}">
                                  <i style="font-size: 25px;" class="mdi mdi-plus-box"></i></a>
                                <a title="Add multiple images" href="{{ url('admin/add-edit-images/'.$product['id']) }}">
                                  <i style="font-size: 25px;" class="mdi mdi-plus-box"></i></a>

                                <a module="product" moduleId="{{ $product['id'] }}" class="confirmDelete" href="javascript:void(0)">
                                  <i style="font-size: 25px;" class="mdi mdi-delete"></i></a>
                                {{-- <a title="product" class="confirmDelete" href="{{ url('admin/delete-product/'.$product['id']) }}">
                                  <i style="font-size: 25px;" class="mdi mdi-delete"></i></a>   --}}
                            </td>
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
