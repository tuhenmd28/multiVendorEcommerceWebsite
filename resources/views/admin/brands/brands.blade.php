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
                <h4 class="card-title">Brand</h4>
                <a style="float: right;" href="{{ url('admin/add-edit-brand') }}" class="btn btn-primary ">Add Brand</a>
                <div class="table-responsive pt-3">
                  <table id="brand" class="table table-bordered text-center">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                        <tr>
                            <td>
                              {{ $brand['id'] }}
                            </td>
                            <td>
                                {{ $brand['name'] }}
                            </td>
                            <td>
                                @if (!empty($brand['image']))
                                <img src="{{url('admin/images/brands/'.$brand['image'])}}" alt="">
                                @endif
                                {{-- {{ $brand['image'] }} --}}
                            </td>

                            <td style="text-align: center;">
                                @if ($brand['status']==1)
                                <a href="javascript:void(0)" class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand-id="{{ $brand['id'] }}">  <i style="font-size: 25px;" class="mdi mdi-bookmark-check" status="active"></i></a>
                                @else
                                <a href="javascript:void(0)" class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand-id="{{ $brand['id'] }}">
                                <i style="font-size: 25px;" class="mdi mdi-bookmark-outline" status="inactive"></i></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/add-edit-brand/'.$brand['id']) }}">
                                  <i style="font-size: 25px;" class="mdi mdi-pencil-box"></i></a>
                                <a module="brand" moduleId="{{ $brand['id'] }}" class="confirmDelete" href="javascript:void(0)">
                                  <i style="font-size: 25px;" class="mdi mdi-delete"></i></a>
                                {{-- <a title="brand" class="confirmDelete" href="{{ url('admin/delete-brand/'.$brand['id']) }}">
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
