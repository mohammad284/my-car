@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@section('content')


@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@if(Auth::guard('admin')->check())

<div class="row">
  <div class="col-lg-7 col-xl-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">{{__('أرباح الأسبوع')}}</h6>
          <div class="dropdown mb-2">


          </div>
        </div>
        <div id="monthlySalesChart"></div>
        <input type="hidden" id="one" value="{{$seven_report}}" />
        <input type="hidden" id="two" value="{{$sixth_report}}" />
        <input type="hidden" id="three" value="{{$fifth_report}}" />
        <input type="hidden" id="four" value="{{$forth_report}}" />
        <input type="hidden" id="five" value="{{$third_report}}" />
        <input type="hidden" id="six" value="{{$second_report}}" />
        <input type="hidden" id="seven" value="{{$first_report}}" />
        <input type="hidden" id="first" value="{{$first}}" />
        <input type="hidden" id="second" value="{{$second}}" />
        <input type="hidden" id="third" value="{{$third}}" />
        <input type="hidden" id="forth" value="{{$forth}}" />
        <input type="hidden" id="fifth" value="{{$fifth}}" />
        <input type="hidden" id="sixth" value="{{$sixth}}" />
        <input type="hidden" id="seventh" value="{{$date}}" />
      </div> 
    </div>
  </div>

</div> <!-- row -->
<div class="row">
  <div class="col-xl-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('أرباح الشهر')}}</h6>
        <input type="hidden" id="A_report" value="{{$first_report_last_month}}" />
        <input type="hidden" id="B_report" value="{{$second_report_last_month}}" />
        <input type="hidden" id="C_report" value="{{$third_report_last_month}}" />
        <input type="hidden" id="D_report" value="{{$forth_report_last_month}}" />
        <input type="hidden" id="E_report" value="{{$fifth_report_last_month}}" />
        <input type="hidden" id="F_report" value="{{$sixth_report_last_month}}" />
        <input type="hidden" id="G_report" value="{{$first_report__month}}" />
        <input type="hidden" id="H_report" value="{{$second_report__month}}" />
        <input type="hidden" id="I_report" value="{{$third_report__month}}" />
        <input type="hidden" id="J_report" value="{{$forth_report__month}}" />
        <input type="hidden" id="K_report" value="{{$fifth_report__month}}" />
        <input type="hidden" id="L_report" value="{{$sixth_report__month}}" />
        <input type="hidden" id="last_month" value="{{__('الشهر الماضي')}}" />
        <input type="hidden" id="this_month" value="{{__('الشهر الحالي')}}" />
        <canvas id="chartjsArea"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">{{__('السيارات المؤجرة')}}</h6>
          <div class="dropdown mb-2">

          </div>
        </div>
        <div id="storageChart" value="20"></div>
        <input id ="financial" type="hidden" value="{{$result}}" />
        <input type="hidden" id="lable" value="{{__('من العدد الكلي')}}" />
        <div class="row mb-3">
          <div class="col-6 d-flex justify-content-end">
            <div>
              <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-bolder"> {{__('العدد الكلي')}}<span class="p-1 ms-1 rounded-circle bg-secondary"></span></label>
              <h5 class="fw-bolder mb-0 text-end">{{$all}}</h5>
            </div>
          </div>
          <div class="col-6">
            <div>
              <label class="d-flex align-items-center tx-10 text-uppercase fw-bolder"><span class="p-1 me-1 rounded-circle bg-primary"></span>{{__('السيارات المؤجرة')}} </label>
              <h5 class="fw-bolder mb-0">{{$booking}}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
            <a href="/admin/allprovider"><h6 class="card-title mb-0">{{__('مزودي الخدمة')}}</h6></a>
              <div class="dropdown mb-2">


              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{count($all_providers)}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/allprovider"><i class="mdi mdi-account-multiple" style="font-size: 50px ;padding-right: 35%;"></i></a> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/admin/allUser"><h6 class="card-title mb-0" >{{__('كل العملاء')}}</h6></a>
              <div class="dropdown mb-2">

              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{count($all_users)}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/allUser"><i class="mdi mdi-account-multiple" style="font-size: 50px ;padding-right: 35%;"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/admin/allCarsType"><h6 class="card-title mb-0">{{__('عدد السيارات الكلي')}} </h6></a>

            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$all}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/allCarsType"><i class="mdi mdi-car" style="font-size: 50px ;padding-right: 35%;"></i> </a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> <!-- row -->
@else
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
            <a href="/provider/providerBooking"><h6 class="card-title mb-0">{{__('حجوزاتي')}}</h6></a>
              <div class="dropdown mb-2">
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$provider_booking}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/provider/providerBooking"><i class="mdi mdi-calendar-clock" style="font-size: 50px ;padding-right: 35%;"></i></a> 
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/provider/allCars"><h6 class="card-title mb-0">{{__('عدد السيارات الكلي')}} </h6></a>

            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$cars}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/provider/allCars"><i class="mdi mdi-car" style="font-size: 50px ;padding-right: 35%;"></i> </a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> <!-- row -->
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
            <a href="/provider/notifications"><h6 class="card-title mb-0">{{__('اشعارات اليوم')}}</h6></a>
              <div class="dropdown mb-2">
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$all_not}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/provider/notifications"><i class="mdi mdi-bell-ring-outline" style="font-size: 50px ;padding-right: 35%;"></i></a> 
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/provider/allAdvirtising"><h6 class="card-title mb-0">{{__('الإعلانات')}} </h6></a>

            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$all_advertising}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/provider/allAdvirtising"><i class="mdi mdi-radio" style="font-size: 50px ;padding-right: 35%;"></i> </a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> <!-- row -->
@endif
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush


@push('custom-scripts')
  <script src="{{ asset('assets/js/chartjs.js') }}"></script>
@endpush
