@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              {{-- <h4 class="font-weight-bold">Catalogue Management</h4> --}}
              <h5 class="card-title">Product</h5>
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
                    {{-- {{ Session::get('page') }} --}}
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
                   @if (empty($product['id']))
                  action="{{ url('/admin/add-edit-product') }}"
                  @else
                  action="{{ url('/admin/add-edit-product/'.$product['id']) }}"
                  @endif  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="category_id">Select category </label>
                      <select name="category_id" id="category_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($categories as $section)
                        <optgroup label="{{ $section['name'] }}"></optgroup>
                            @foreach ($section['categories'] as $category)
                            <option @if (!empty($category['id']) && $category['id'] == $product['category_id']) selected @endif value="{{ $category['id'] }}"> &nbsp;&nbsp;&nbsp;--{{ $category['category_name'] }}</option>
                                @foreach ($category['sub_categories'] as $subcategory)
                                <option @if (!empty($subcategory['id']) && $subcategory['id'] == $product['category_id']) selected @endif value="{{ $subcategory['id'] }}"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--{{ $subcategory['category_name'] }}</option>
                                @endforeach
                            @endforeach
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="brand_id">Select Brand </label>
                      <select name="brand_id" id="brand_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($brands as $brand)
                        <option @if (!empty($brand['id']) && $brand['id'] == $product['brand_id']) selected @endif value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="product_name">Product Name</label>
                      <input type="text" value="{{ empty($product['product_name'])? old('product_name'):$product['product_name'] }}" name="product_name" class="form-control" id="product_name" placeholder="Enter product name"  >
                    </div>
                    <div class="form-group">
                      <label for="product_code">Product Code</label>
                      <input type="text" value="{{ empty($product['product_code'])? old('product_code'):$product['product_code'] }}" name="product_code" class="form-control" id="product_code" placeholder="Enter product code"  >
                    </div>
                    <div class="form-group">
                      <label for="product_color">Product Color</label>
                      <input type="text" value="{{ empty($product['product_color'])? old('product_color'):$product['product_color'] }}" name="product_color" class="form-control" id="product_color" placeholder="Enter product color"  >
                    </div>
                    <div class="form-group">
                      <label for="product_price">Product Price</label>
                      <input type="text" value="{{ empty($product['product_price'])? old('product_price'):$product['product_price'] }}" name="product_price" class="form-control" id="product_price" placeholder="Enter product price"  >
                    </div>
                    <div class="form-group">
                      <label for="product_discount">Product Discount (%)</label>
                      <input type="text" value="{{ empty($product['product_discount'])? old('product_discount'):$product['product_discount'] }}" name="product_discount" class="form-control" id="product_discount" placeholder="Enter product discount"  >
                    </div>
                    <div class="form-group">
                      <label for="product_weight">Product Weight</label>
                      <input type="text" value="{{ empty($product['product_weight'])? old('product_weight'):$product['product_weight'] }}" name="product_weight" class="form-control" id="product_weight" placeholder="Enter product weight"  >
                    </div>
                    <div class="form-group">
                      <label for="product_image">product Image ( Recommend size:1000x1000)</label>
                      <input type="file"  name="product_image" class="form-control" id="product_image" >
                      <input type="hidden" name="currentproductImage" value="{{ empty($product['product_image'])? old('product_image'):$product['product_image'] }}">
                      @if (!empty($product['product_image']))
                      <a style="padding:10px 0;" target="_blank"  href="{{ url('fontend/images/product_images/large/'.$product['product_image']) }}" > View image
                    </a>
                    <a module="product-image" moduleId="{{ $product['id'] }}" class="confirmDelete" href="javascript:void(0)">
                      Delete Image</a>
                     @endif
                    </div>
                    <div class="form-group">
                      <label for="product_video">product Video ( Recommend size less than 2MB)</label>
                      <input type="file"  name="product_video" class="form-control" id="product_video" >
                      <input type="hidden" name="currentproductVideo" value="{{ empty($product['product_video'])? old('product_video'):$product['product_video'] }}">
                      @if (!empty($product['product_video']))
                      <a style="padding:10px 0;" target="_blank"  href="{{ url('fontend/videos/product_video/'.$product['product_video']) }}" > View video
                    </a>
                    <a module="product-video" moduleId="{{ $product['id'] }}" class="confirmDelete" href="javascript:void(0)">
                      Delete video</a>
                     @endif

                    </div>

                    <div class="form-group">
                      <label for="description">product Description</label>
                      <textarea name="description" id="description"  rows="3" class="form-control"> {{ empty($product['description'])? old('description'):$product['description'] }} </textarea>
                    </div>
                    <div class="form-group">
                      <label for="meta_title">Meta Title</label>
                      <input type="text" value="{{ empty($product['meta_title'])? old('meta_title'):$product['meta_title'] }}" name="meta_title" class="form-control" id="meta_title" placeholder="Enter meta title"  >
                    </div>
                    <div class="form-group">
                      <label for="meta_description">	Meta Descriptin</label>
                      <input type="text" value="{{ empty($product['meta_description'])? old('meta_description'):$product['meta_description'] }}" name="meta_description" class="form-control" id="meta_description" placeholder="Enter Meta Description"  >
                    </div>
                    <div class="form-group">
                      <label for="meta_keyword">Meta Keywords</label>
                      <input type="text" value="{{ empty($product['meta_keyword'])? old('meta_keyword'):$product['meta_keyword'] }}" name="meta_keyword" class="form-control" id="meta_keyword" placeholder="Enter Meta Keywords"  >
                    </div>
                    <div class="form-group">
                      <label for="is_featured">Featured Item</label>
                     <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if (!empty($product['is_featured']) && $product['is_featured']=='Yes') checked @endif>
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
