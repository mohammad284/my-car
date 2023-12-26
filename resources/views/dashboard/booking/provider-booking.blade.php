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
        <h6 class="card-title">{{__('إدارة الحجوزات')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('اسم السيارة')}}</th>
                <th>{{__('رقم السيارة')}}</th>
                <th>{{__('اسم المستأجر')}}</th>
                <th>{{__('أيميل المستأجر')}}</th>
                <th>{{__('من تاريخ')}}</th>
                <th>{{__('إلى تاريخ')}}</th>
                <th>{{__('السعر')}}</th>
                <th>{{__('الحالة')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td>{{$car['car']->name}}</td>
                    <td>{{$car['car']->number_of_car}}</td>
                    <td>{{$car['user']->name}}</td>
                    <td>{{$car['user']->email}}</td>
                    <td>{{$car->start_date}}</td>
                    <td>{{$car->end_date}}</td>
                    <td>{{$car->price}}</td>
                    @if($car->status == 'finished') 
                      <td>{{__('تم الإنهاء')}}</td>
                      <td class="action"> 
                        <a  title="{{__('حذف')}}" href="/provider/deleteBooking/{{$car->id}}"><i data-feather="trash"></i></i></a>
                    </td>
                    @endif
                    @if($car->status == 'prossing') 
                      <td>{{__('مؤجرة')}}</td>
                      <td class="action"> 
                        <a  title="{{__('إنهاء')}}" href="/provider/changeStatus/{{$car->id}}"><i data-feather="slash"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/provider/deleteBooking/{{$car->id}}"><i data-feather="trash"></i></i></a>
                    </td>
                    @endif
                    @if($car->status == 'waiting') 
                      <td>{{__('بإنتظار الموافقة')}}</td>
                      <td class="action"> 
                        <a  title="{{__('موافقة')}}" href="/provider/changeStatus/{{$car->id}}"><i data-feather="check-square"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/provider/deleteBooking/{{$car->id}}"><i data-feather="trash"></i></i></a>
                    </td>
                    @endif

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush