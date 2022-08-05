@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              {{-- <h4 class="font-weight-bold">Catalogue Management</h4> --}}
              <h5 class="card-title">Categories</h5>
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
                   @if (empty($category['id']))
                  action="{{ url('/admin/add-edit-category') }}"
                  @else
                  action="{{ url('/admin/add-edit-category/'.$category['id']) }}"  
                  @endif  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="category_name">Category Name</label>
                      <input type="text" value="{{ empty($category['category_name'])? old('category_name'):$category['category_name'] }}" name="category_name" class="form-control" id="category_name" placeholder="Enter category name" required>
                    </div>
                    <div class="form-group">
                      <label for="section_id">Select Section </label>
                      <select name="section_id" id="section_id" class="form-control">
                        <option value="">Select</option>
                        @foreach ($getSection as $section)
                        <option @if ( !empty($section['id']) && $category['section_id']== $section['id'])
                            selected
                        @endif value="{{ $section['id'] }}">{{ $section['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="appendCategoriesLavel">
                      @include('admin.categories.append_categories_lavel')
                    </div>
                    <div class="form-group">
                      <label for="category_image">Category Image</label>
                      <input type="file"  name="category_image" class="form-control" id="category_image" >
                    </div>
                    <div class="form-group">
                      <label for="category_discount">Category Discount</label>
                      <input type="text" value="{{ empty($category['category_discount'])? old('category_discount'):$category['category_discount'] }}" name="category_discount" class="form-control" id="category_discount" placeholder="Enter category name" required>
                    </div>
                    <div class="form-group">
                      <label for="category_description">Category Description</label>
                      <textarea name="category_description" id="category_description"  rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="url">Category URL</label>
                      <input type="text" value="{{ empty($category['url'])? old('url'):$category['url'] }}" name="url" class="form-control" id="url" placeholder="Enter category URL" required>
                    </div>
                    <div class="form-group">
                      <label for="meta_title">Meta Title</label>
                      <input type="text" value="{{ empty($category['meta_title'])? old('meta_title'):$category['meta_title'] }}" name="meta_title" class="form-control" id="meta_title" placeholder="Enter meta title" required>
                    </div>
                    <div class="form-group">
                      <label for="meta_descriptin">	Meta Descriptin</label>
                      <input type="text" value="{{ empty($category['meta_descriptin'])? old('meta_descriptin'):$category['meta_descriptin'] }}" name="meta_descriptin" class="form-control" id="meta_descriptin" placeholder="Enter Meta Descriptin" required>
                    </div>
                    <div class="form-group">
                      <label for="meta_keywords">Meta Keywords</label>
                      <input type="text" value="{{ empty($category['meta_keywords'])? old('meta_keywords'):$category['meta_keywords'] }}" name="meta_keywords" class="form-control" id="meta_keywords" placeholder="Enter Meta Keywords" required>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light" type="reset">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
     </div>
           
 
@include('admin.layout.footer')
</div>
</div>
@endsection