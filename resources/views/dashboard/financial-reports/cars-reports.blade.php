@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

@endpush
@section('content')
<h4 id="default">{{__('تقارير مالية')}}</h4>
    <p class="mb-3"> {{__('إحصائيات عدد السيارات المستأجرة')}}</p>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
          <h6 class="card-title">{{__('تطبيق فلتر بحث')}}</h6>
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/carReportFilter">
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
                        {{__('عدد السيارات الكلي')}}
                      </th>
                      <th>
                        {{__('السيارات المستأجرة')}}
                      </th>
                      <th>
                        {{__('التاريخ')}}
                      </th>
                      <th>
                        {{__('تفاصيل الإستأجار')}}
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cars_details as $details)
                        <tr>
                        <td class="py-1">
                            {{$details['provider']->name}}
                        </td>
                        <td>
                        {{$details['provider']->company_name}}
                        </td>
                        <td>
                        {{$details['total_car']}}
                        </td>
                        <td>
                        {{$details['today_booking']}}
                        </td>
                        <td>
                        {!! date('d/M/Y', strtotime($date)) !!}
                        </td>
                        <td class="action"> 
                            <a  title="{{__('تفاصيل الإستأجار')}}" href="/admin/autoDetailstoday/{{$details['provider']->id}}"> <i data-feather="eye"></i></i></a>
                        </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <a type="button" href="/admin/printTodayCarReport" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
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
                        {{__('عدد السيارات الكلي')}}
                      </th>
                      <th>
                        {{__('السيارات المستأجرة')}}
                      </th>
                      <th>
                      {{__('من تاريخ')}}
                      </th>
                      <th>
                      {{__('إلى تاريخ')}}
                      </th>
                      <th>
                        {{__('تفاصيل الإستأجار')}}
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cars_details as $details)
                        <tr>
                        <td class="py-1">
                            {{$details['provider']->name}}
                        </td>
                        <td>
                        {{$details['provider']->company_name}}
                        </td>
                        <td>
                        {{$details['total_car']}}
                        </td>
                        <td>
                        {{$details['week_booking']}}
                        </td>
                        <td>
                        {!! date('d/M/Y', strtotime($details['from'])) !!}
                        </td>
                        <td>
                        {!! date('d/M/Y', strtotime($date)) !!}
                        </td> 
                        <td class="action"> 
                            <a  title="{{__('تفاصيل الإستأجار')}}" href="/admin/autoDetailsweek/{{$details['provider']->id}}"> <i data-feather="eye"></i></i></a>
                        </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <a type="button" href="/admin/printWeekCarReport"  class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
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
                        {{__('عدد السيارات الكلي')}}
                      </th>
                      <th>
                        {{__('السيارات المستأجرة')}}
                      </th>
                      <th>
                      {{__('من تاريخ')}}
                      </th>
                      <th>
                      {{__('إلى تاريخ')}}
                      </th>
                      <th>
                        {{__('تفاصيل الإستأجار')}}
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cars_details as $details)
                        <tr>
                        <td class="py-1">
                            {{$details['provider']->name}}
                        </td>
                        <td>
                        {{$details['provider']->company_name}}
                        </td>
                        <td>
                        {{$details['total_car']}}
                        </td>
                        <td>
                        {{$details['month_booking']}}
                        </td>
                        <td>
                        {!! date('d/M/Y', strtotime($details['month'])) !!}
                        </td>
                        <td>
                        {!! date('d/M/Y', strtotime($date)) !!}
                        </td> 
                        <td class="action"> 
                            <a  title="{{__('تفاصيل الإستأجار')}}" href="/admin/autoDetailsMonth/{{$details['provider']->id}}"> <i data-feather="eye"></i></i></a>
                        </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <a type="button" href="/admin/printMonthCarReport" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
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
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
@endpush
@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/timepicker.js') }}"></script>

@endpush