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
                {{-- <h4 class="card-title">Categories</h4> --}}
                {{-- <h4 class="font-weight-bold">Catalogue Management</h4> --}}
              <h5 class="card-title">Categories</h5>
                <a style="float: right;" href="{{ url('admin/add-edit-category') }}" class="btn btn-primary ">Add Category</a>
                <div class="table-responsive pt-3">
                  <table id="category" class="table table-bordered text-center">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Parent Category</th>
                        <th>Section</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        @php if(isset($category['parent_category']['category_name']) && !empty($category['parent_category']['category_name'])){
                          $parentCategory = $category['parent_category']['category_name'];
                        }else{
                          $parentCategory = 'Root';
                        }
                        @endphp
                        <tr>
                            <td>
                              {{ $category['id'] }}
                            </td>
                            <td>
                                {{ $category['category_name'] }}
                            </td>
                            <td>
                                {{ $parentCategory }}
                            </td>
                            <td>
                                {{ $category['section']['name'] }}
                            </td>
                           
                            <td>
                                {{ $category['url'] }}
                            </td>
                           
                            <td style="text-align: center;">
                                @if ($category['status']==1)
                                <a href="javascript:void(0)" class="updatecategoryStatus" id="category-{{ $category['id'] }}" category-id="{{ $category['id'] }}">  <i style="font-size: 25px;" class="mdi mdi-bookmark-check" status="active"></i></a>
                                @else
                                <a href="javascript:void(0)" class="updatecategoryStatus" id="category-{{ $category['id'] }}" category-id="{{ $category['id'] }}">
                                <i style="font-size: 25px;" class="mdi mdi-bookmark-outline" status="inactive"></i></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/add-edit-category/'.$category['id']) }}">
                                  <i style="font-size: 25px;" class="mdi mdi-pencil-box"></i></a>  
                                <a module="category" moduleId="{{ $category['id'] }}" class="confirmDelete" href="javascript:void(0)">
                                  <i style="font-size: 25px;" class="mdi mdi-delete"></i></a>  
                                {{-- <a title="category" class="confirmDelete" href="{{ url('admin/delete-category/'.$category['id']) }}">
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