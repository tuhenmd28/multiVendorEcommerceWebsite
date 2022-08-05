@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{ $type }}</h4>
                <p class="card-description">
                  Add class <code>.table-bordered</code>
                </p>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                          Id
                        </th>
                        <th>
                          Name
                        </th>
                        <th>
                          Type
                        </th>
                        <th>
                          Mobile
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Image
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>
                              {{ $admin['id'] }}
                            </td>
                            <td>
                                {{ $admin['name'] }}
                            </td>
                            <td>
                                {{ $admin['type'] }}
                            </td>
                            <td>
                                {{ $admin['mobile'] }}
                            </td>
                            <td>
                                {{ $admin['email'] }}
                            </td>
                            <td>
                                <img src="{{ asset('admin/images/uploads/'.$admin['image'])   }}" alt="">
                                {{-- {{ $admin['image'] }} --}}
                            </td>
                            <td style="text-align: center;">
                                @if ($admin['status']==1)
                                <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin-id="{{ $admin['id'] }}">  <i style="font-size: 25px;" class="mdi mdi-bookmark-check" status="active"></i></a>
                                @else
                                <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin-id="{{ $admin['id'] }}">
                                <i style="font-size: 25px;" class="mdi mdi-bookmark-outline" status="inactive"></i></a>
                                @endif
                                {{-- {{ $admin['status'] }} --}}
                            </td>
                            <td>
                              @if ($admin['type'] == 'vendor')
                                <a href="{{ url('admin/view-vendor-details/'.$admin['id']) }}">
                                  <i style="font-size: 25px;" class="mdi mdi-file-document"></i></a>  
                              @endif
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