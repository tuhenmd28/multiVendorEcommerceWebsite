@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              {{-- <h4 class="font-weight-bold">Catalogue Management</h4> --}}
              <h5 class="card-title">Attributes</h5>
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
                  <h4 class="card-title">Add Attribute</h4>

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
                  <form class="forms-sample" method="POST" action="{{ url('/admin/add-edit-attributes/'.$product['id']) }}" >
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
                        <div>
                            <input  type="text" name="size[]" placeholder="size" required/>
                            <input  type="text" name="SKU[]" placeholder="SKU" required/>
                            <input  type="text" name="price[]" placeholder="price" required/>
                            <input  type="text" name="stock[]" placeholder="stock" required/>
                            <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                        </div>
                    </div>
                </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light" type="reset">Cancel</button>
                  </form>
                  <br><br><br>
                  <h5 class="card-title">Product Attributes</h5>
                  <div class="table-responsive pt-3">
                    <form action="{{ url('admin/edit-attribute/'.$product['id']) }}" method="post">
                        @csrf
                     <table id="productAttributea" class="table table-bordered text-center">
                       <thead>
                         <tr>
                           <th>Id</th>
                           <th>Size</th>
                           <th>SKU</th>
                           <th>Price</th>
                           <th>Stock</th>
                           <th>Status</th>
                           {{-- <th>Action</th> --}}
                         </tr>
                       </thead>
                       <tbody>
                           @foreach ($product['attributes'] as $attribute)
                           <input type="text" class="d-none" required  name="attributeId[]" value="{{ $attribute['id'] }}">
                           <tr>
                               <td>
                                 {{ $attribute['id'] }}
                               </td>
                               <td>
                                   {{ $attribute['size'] }}
                               </td>
                               <td>
                                   {{ $attribute['SKU'] }}
                               </td>
                               <td class="edit">
                                <input type="number" required  name="price[]" value="{{ $attribute['price'] }}">
                                   {{-- {{ $attribute['price'] }} --}}
                               </td>
                               <td class="edit">
                                <input type="number" required  name="stock[]" value="{{ $attribute['stock'] }}">
                                   {{-- {{ $attribute['stock'] }} --}}
                               </td>

                               <td style="text-align: center;">
                                   @if ($attribute['status']==1)
                                   <a href="javascript:void(0)" class="updateProductAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute-id="{{ $attribute['id'] }}">  <i style="font-size: 25px;" class="mdi mdi-bookmark-check" status="active"></i></a>
                                   @else
                                   <a href="javascript:void(0)" class="updateProductAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute-id="{{ $attribute['id'] }}">
                                   <i style="font-size: 25px;" class="mdi mdi-bookmark-outline" status="inactive"></i></a>
                                   @endif
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
                    <button class="btn btn-primary my-4 ml-auto"  type="submit">Update Attribute</button>
                 </form>
              </div>
                </div>
              </div>
            </div>
     </div>


@include('admin.layout.footer')
</div>
</div>
@endsection
