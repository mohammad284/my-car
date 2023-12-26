@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('content')

<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <form class="forms-sample">
            <fieldset disabled="disabled">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{__('الاسم')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->name}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الأيميل')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$provider->email}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('اسم الشركة')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$provider->company_name}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('رقم السجل التجاري')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->cr_number}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('السيارات الكلي')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$total_car}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('نسبة الأرباح')}} %</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->percentage}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('العنوان')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->provider_address}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الدولة')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider['countries']->country}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('المدينة')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider['cities']->city}}" />
                    </div>
                </div>
            </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('السيارات')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('اسم السيارة')}}</th>
                <th>{{__('نوع السيارة')}}</th>
                <th>{{__('السعر')}}</th>
                <th>{{__('التقييم')}}</th>
                <th>{{__('معلومات إضافة')}}</th>
                <th> {{__('المقاعد')}}</th>
                <th> {{__('الأبواب')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($cars_details as $details)
                <tr>
                    <td>{{$details['car']->name}}</td>
                    <td>{{$details['type']->type}}</td>
                    <td>{{$details['car']->price_for_day}}</td>
                    <td>{{$details['car']->rating}}</td>
                    <td>{{$details['car']->extra_information}}</td>
                    <td>{{$details['car']->site}}</td>
                    <td>{{$details['car']->door}}</td>
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