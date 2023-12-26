@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "ar";
  }
?>
  @if($lang == 'en')
  <link href="{{ asset('assets/massageltr.css') }}" rel="stylesheet" />
  @else
  <link href="{{ asset('assets/massage.css') }}" rel="stylesheet" />
  @endif
@endpush
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
@section('content')


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('إشعارات التطبيق')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('عنوان الاشعار')}}</th>
                <th>{{__('الإشعار/عربي')}}</th>
                <th>{{__('الإشعار/إنكليزي')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
            @foreach($app_notifications as $app_notification)
                <tr>
                    <td>{{$app_notification->title}}</td>
                    <td>{{$app_notification->notification_ar}}</td>
                    <td>{{$app_notification->notification_en}}</td>
                    <td class="action">
                        <a  title="{{__('تعديل')}}"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$app_notification->id}}"><i data-feather="edit"></i></i></a></a>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@foreach($app_notifications as $app_notification)
<div class="modal fade" id="exampleModal-{{$app_notification->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('تعديل الإشعار')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateNotification/{{$app_notification->id}}">
            @csrf

            <div class="row mb-6">
                  
                <label for="exampleInputNumber1" class="form-label">{{__('الإشعار/عربي')}}</label>
                <input class="form-control mb-4 mb-md-0" name="notification_ar" value="{{$app_notification->notification_ar}}"  required/>
                <div >
                    <br>
                </div>
                <label for="exampleInputNumber1" class="form-label">{{__('الإشعار/إنكليزي')}}</label>
                <input class="form-control mb-4 mb-md-0" name="notification_en"  value="{{$app_notification->notification_en}}"  required/>
                <div >
                <br>
                </div>


            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
            </div>
              
          </div>
        </div>
      </div>
      @endforeach
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush