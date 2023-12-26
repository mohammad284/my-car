@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush

@section('content')
<h4 id="default">{{__('تقارير مالية')}}</h4>
    <p class="mb-3">  {{__('أرباح التطبيق من مزودي الخدمة')}}</p>
    <div class="example">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">{{__('يومية')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false">{{__('اسبوعية')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" role="tab" aria-controls="contact" aria-selected="false">{{__('شهرية')}}</a>
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
                    <th>
                        {{__('مزود الخدمة')}}
                      </th>
                      <th>
                        {{__('اسم الشركة')}}
                      </th>
                      <th>
                        {{__('عدد السيارات المؤجرة')}}
                      </th>
                      <th>
                        {{__('أرباح مزود الخدمة')}}
                      </th>
                      <th>
                        {{__('نسبة الربح')}}
                      </th>
                      <th>
                      {{__('أرباح التطبيق')}}
                      </th>
                      <th>
                        {{__('التاريخ')}}
                      </th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($earning_details as $details)
                        <tr>
                        <td class="py-1">
                            {{$details['provider']->name}}
                        </td>
                        <td>
                            {{$details['provider']->company_name}}
                        </td>
                        <td>
                            {{$details['today_cars']}}
                        </td>
                        <td>
                            {{$details['today_commission']}}
                        </td>
                        <td>
                            {{$details['provider']->percentage}}
                        </td>
                        <td>
                            {{$details['daily_earning']}}
                        </td>
                        <td>
                            {!! date('d/M/Y', strtotime($date)) !!}
                        </td>

                        </tr>
                    @endforeach
                  </tbody>
                  <a type="button" href="/admin/printTodayProviderEarning" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="printer"></i>
                    Export to PDF
                  </a>
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
                    <th>
                        {{__('مزود الخدمة')}}
                      </th>
                      <th>
                        {{__('اسم الشركة')}}
                      </th>
                      <th>
                        {{__('عدد السيارات المؤجرة')}}
                      </th>
                      <th>
                        {{__('أرباح مزود الخدمة')}}
                      </th>
                      <th>
                        {{__('نسبة الربح')}}
                      </th>
                      <th>
                      {{__('أرباح التطبيق')}}
                      </th>
                      <th>
                        {{__('التاريخ')}}
                      </th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($earning_details as $details)
                        <tr>
                        <td class="py-1">
                            {{$details['provider']->name}}
                        </td>
                        <td>
                            {{$details['provider']->company_name}}
                        </td>
                        <td>
                            {{$details['week_cars']}}
                        </td>
                        <td>
                            {{$details['week_commission']}}
                        </td>
                        <td>
                            {{$details['provider']->percentage}}
                        </td>
                        <td>
                            {{$details['weekly_earning']}}
                        </td>
                        <td>
                            {!! date('d/M/Y', strtotime($date)) !!}
                        </td>

                        </tr>
                    @endforeach
                  </tbody>
                  <a type="button" href="/admin/printWeekProviderEarning" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="printer"></i>
                    Export to PDF
                  </a>
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
                    <th>
                        {{__('مزود الخدمة')}}
                      </th>
                      <th>
                        {{__('اسم الشركة')}}
                      </th>
                      <th>
                        {{__('عدد السيارات المؤجرة')}}
                      </th>
                      <th>
                        {{__('أرباح مزود الخدمة')}}
                      </th>
                      <th>
                        {{__('نسبة الربح')}}
                      </th>
                      <th>
                      {{__('أرباح التطبيق')}}
                      </th>
                      <th>
                        {{__('التاريخ')}}
                      </th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($earning_details as $details)
                        <tr>
                        <td class="py-1">
                            {{$details['provider']->name}}
                        </td>
                        <td>
                            {{$details['provider']->company_name}}
                        </td>
                        <td>
                            {{$details['month_cars']}}
                        </td>
                        <td>
                            {{$details['month_commission']}}
                        </td>
                        <td>
                            {{$details['provider']->percentage}}
                        </td>
                        <td>
                            {{$details['monthly_earning']}}
                        </td>
                        <td>
                            {!! date('d/M/Y', strtotime($date)) !!}
                        </td>

                        </tr>
                    @endforeach
                  </tbody>
                  <a type="button" href="/admin/printMonthProviderEarning" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="printer"></i>
                    Export to PDF
                  </a>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
        </div>

      </div>
    </div>

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