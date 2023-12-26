@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush
@section('content')

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">{{__('الحجوزات')}}</h2>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('اسم السيارة')}}</th>
                <th>{{__('مزود الخدمة')}}</th>
                <th>{{__('رقم السيارة')}}</th>
                <th> {{__('تاريح الطلب')}}</th>
                <th>{{__('تاريخ التسليم')}}</th>
                <th>{{__('موعد إنتهاء الاجار')}}</th>
                <th> {{__('الحالة')}}</th>
                <th> {{__('إرسال إشعار')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($booking_details as $details)
                <tr>
                    <td>{{$details['car']->name}}</td>
                    <td>{{$details['provider']->name}}</td>
                    <td>{{$details['car']->number_of_car}}</td>
                    <td>{{$details['booking']->created_at}}</td>
                    <td>{{$details['booking']->start_date}}</td>
                    <td>{{$details['booking']->end_date}}</td>
                    
                    @if($details['booking']->status == 'finished') 
                      <td>{{__('تم الإنهاء')}}</td>
                    @endif
                    @if($details['booking']->status == 'prossing') 
                      <td>{{__('قيد العمل')}}</td>
                    @endif
                    @if($details['booking']->status == 'waiting') 
                      <td>{{__('بإنتظار الموافقة')}}</td>
                    @endif
                    <td class="action"> 
                    <a type="button"  title="{{__('رد')}}" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$details['booking']->id}}"> <i class="mdi mdi-reply"></i></a>

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
@foreach($booking_details as $details)
      <div class="modal fade" id="exampleModal-{{$details['booking']->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('الرد على الرسالة')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" enctype="multipart/form-data" action="/admin/sendTextNotification">
                @csrf
                <div class="mb-3">
                  <label for="recipient-name" class="form-label">{{__('نص الرسالة/عربي')}} :</label>
                  <input type="text" class="form-control" name="notification_ar" id="exampleInputNumber1"  required>
                  <input type ="hidden" class="form-control mb-4 mb-md-0" value="{{$details['provider']->id}}" name="provider"  required/>
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="form-label">{{__('نص الرسالة/انكليزي')}} :</label>
                  <input type="text" class="form-control" name="notification_en" id="exampleInputNumber1"  required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
                </div>
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
