@extends('dashboard.layout.master')
@push('plugin-styles')
<?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "ar";
  }
?>
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('content')
@if(Auth::guard('admin')->check())
    @else
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
          <h6 class="card-title">{{__('تطبيق فلتر بحث')}}</h6>
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/provider/financialFilter">
              @csrf
              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">{{__('من')}}</label>
                  <input class="date form-control"  name="start" type="date">
                </div>
                <div class="col-md-6">
                  <label class="form-label">{{__('إلى')}}</label>
                  <input class="date form-control"  name="end" type="date">
                </div>
              </div>
              <button type="submit" class="btn btn-primary me-2">{{__('تطبيق')}}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endif
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('الارباح')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('اسم السيارة')}}</th>
                <th>{{__('نوع السيارة')}}</th>
                <th>{{__('لون السيارة')}}</th>
                <th>{{__('اسم المستأجر')}}</th>
                <th>{{__('الهاتف')}}</th>
                <th>{{__('تاريخ الاستأجار')}}</th>
                <th>{{__('المبلغ المدفوع')}}</th>
              </tr>
            </thead>
            <tbody>
            @foreach($booking_details as $details)
                <tr>
                    <td>{{$details['car']->name}}</td>
                    <td>{{$details['car_type']->type}}</td>@if($lang == 'ar')
                    <td>{{$details['color']->color_ar}}</td>@else <td>{{$details['color']->color_en}}</td>@endif
                    <td>{{$details['user']->name}}</td>
                    <td>{{$details['user']->mobile}}</td>
                    <td>{{$details['booking']->created_at}}</td>
                    <td>{{$details['booking']->price}}</td>
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