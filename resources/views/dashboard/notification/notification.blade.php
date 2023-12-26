@extends('dashboard.layout.master')
@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush

@section('content')
<h4 id="default">{{__('الاشعارات')}}</h4>
@if(Auth::guard('admin')->check())
    <div class="example">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">{{__('إشعارات تسجيل الدخول')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false">{{__('إشعارات تعديل الحسابات')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" role="tab" aria-controls="contact" aria-selected="false">{{__('إشعارات إضافة السيارات')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="advertising-tab" data-bs-toggle="tab" data-bs-target="#advertising" role="tab" aria-controls="advertising" aria-selected="false">{{__('إشعارات تعديل السيارات')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" role="tab" aria-controls="admin" aria-selected="false">{{__('الإشعارات المرسلة من الأدمن')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="booking-tab" data-bs-toggle="tab" data-bs-target="#booking" role="tab" aria-controls="booking" aria-selected="false">{{__('إشعارات الحجز')}}</a>
        </li>
      </ul>
        <div class="tab-content border border-top-0 p-3" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{__('الاشعارات')}}</th>
                                            <th>{{__('المستقبل')}}</th>
                                            <th class="action">{{__('خيارات')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($register_notifications_details as $register_notification)
                                                <tr>
                                                    <td>{{$register_notification['notification']->notification}}</td>
                                                    @if (Auth::user()->type == 'admin')
                                                    <td><a href="/admin/moreDetails/{{$register_notification['resever']->id}}" >{{$register_notification['resever']->name}}</a></td>
                                                    @else
                                                    <td>{{$register_notification['resever']->name}}</td>
                                                    @endif
                                                    <td class="action"> 
                                                        <a  title="{{__('حذف')}}" href="/admin/removeCar/{{$register_notification['notification']->id}}"><i data-feather="trash"></i></i></a>
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
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{__('الاشعارات')}}</th>
                                                <th>{{__('المستقبل')}}</th>
                                                <th class="action">{{__('خيارات')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($update_notifications_details as $update_notification)
                                                <tr>
                                                    <td>{{$update_notification['notification']->notification}}</td>
                                                    @if (Auth::user()->type == 'admin')
                                                    <td><a href="/admin/moreDetails/{{$register_notification['resever']->id}}" >{{$update_notification['resever']->name}}</a></td>
                                                    @else
                                                    <td>{{$register_notification['resever']->name}}</td>
                                                    @endif
                                                    <td class="action"> 
                                                        <a  title="{{__('حذف')}}" href="/admin/removeCar/{{$update_notification['notification']->id}}"><i data-feather="trash"></i></i></a>
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
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{__('الاشعارات')}}</th>
                                                <th>{{__('المستقبل')}}</th>
                                                <th class="action">{{__('خيارات')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($add_car_notifications_details as $update_notification)
                                                <tr>
                                                    <td>{{$update_notification['notification']->notification}}</td>
                                                    @if (Auth::user()->type == 'admin')
                                                    <td><a href="/admin/moreDetails/{{$register_notification['resever']->id}}" >{{$update_notification['resever']->name}}</a></td>
                                                    @else
                                                    <td>{{$register_notification['resever']->name}}</td>
                                                    @endif
                                                    <td class="action"> 
                                                        <a  title="{{__('حذف')}}" href="/admin/removeCar/{{$update_notification['notification']->id}}"><i data-feather="trash"></i></i></a>
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
            </div>
            <div class="tab-pane fade" id="advertising" role="tabpanel" aria-labelledby="advertising-tab">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{__('الاشعارات')}}</th>
                                                <th>{{__('المستقبل')}}</th>
                                                <th class="action">{{__('خيارات')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($add_ad_notifications_details as $update_notification)
                                                <tr>
                                                    <td>{{$update_notification['notification']->notification}}</td>
                                                    @if (Auth::user()->type == 'admin')
                                                    <td><a href="/admin/moreDetails/{{$register_notification['resever']->id}}" >{{$update_notification['resever']->name}}</a></td>
                                                    @else
                                                    <td>{{$register_notification['resever']->name}}</td>
                                                    @endif
                                                    <td class="action"> 
                                                        <a  title="{{__('حذف')}}" href="/admin/removeCar/{{$update_notification['notification']->id}}"><i data-feather="trash"></i></i></a>
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
            </div>
            <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{__('الاشعارات')}}</th>
                                                <th>{{__('المستقبل')}}</th>
                                                <th class="action">{{__('خيارات')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($admin_notifications_details as $update_notification)
                                                <tr>
                                                    <td>{{$update_notification['notification']->notification}}</td>
                                                    @if (Auth::user()->type == 'admin')
                                                    <td><a href="/admin/moreDetails/{{$register_notification['resever']->id}}" >{{$update_notification['resever']->name}}</a></td>
                                                    @else
                                                    <td>{{$register_notification['resever']->name}}</td>
                                                    @endif
                                                    <td class="action"> 
                                                        <a  title="{{__('حذف')}}" href="/admin/removeCar/{{$update_notification['notification']->id}}"><i data-feather="trash"></i></i></a>
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
            </div>     
            <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{__('الاشعارات')}}</th>
                                                <th>{{__('المستقبل')}}</th>
                                                <th class="action">{{__('خيارات')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($booking_notifications_details as $update_notification)
                                                <tr>
                                                    <td>{{$update_notification['notification']->notification}}</td>
                                                    @if (Auth::user()->type == 'admin')
                                                    <td><a href="/admin/moreDetails/{{$register_notification['resever']->id}}" >{{$update_notification['resever']->name}}</a></td>
                                                    @else
                                                    <td>{{$register_notification['resever']->name}}</td>
                                                    @endif
                                                    <td class="action"> 
                                                        <a  title="{{__('حذف')}}" href="/admin/removeCar/{{$update_notification['notification']->id}}"><i data-feather="trash"></i></i></a>
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
            </div>    
        </div>
    </div>
@else
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('الاشعارات')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الاشعار')}}</th>
                <th>{{__('تاريخ الاشعار')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($provider_not as $not)
                <tr>
                    <td>{{$not->notification}}</td>
                    <td>{{$not->created_at}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  
@endpush
@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
