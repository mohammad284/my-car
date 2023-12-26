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
        <h6 class="card-title">{{__('تقارير مالية')}}</h6>
        <p class="mb-3"> {{__('إحصائيات عدد السيارات المستأجرة')}}</p>
        <form method="POST" enctype="multipart/form-data" action="/admin/printfilterCarReport">
          @csrf
          <div class="form_item">
            <input type="hidden" name="start" value="{{$start_date}}" />
            <input type="hidden" name="end" value="{{$end_date}}" />
            <button  type="submit" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0" >
            <i class="btn-icon-prepend" data-feather="printer"></i>
              Export to PDF
            </button>
          </div>
        </form>

        <div class="table-responsive">
          <table id="dataTableExample" class="table">
                <thead>
                      <tr>
                        <th>
                          {{__('مزود الخدمة')}}
                        </th>
                        <th>
                          {{__('اسم الشركة')}}
                        </th>
                        <th>
                          {{__('الأرباح')}}
                        </th>
                        <th>
                            {{__('من تاريخ')}}
                        </th>
                        <th>
                            {{__('إلى تاريخ')}}
                        </th>
                      </tr>
                    </thead>
                <tbody>
                    @foreach($filter_details as $details)
                          <tr>
                            <td class="py-1">
                                {{$details['provider']->name}}
                            </td>
                            <td>
                            {{$details['provider']->company_name}}
                            </td>
                            <td>
                            {{$details['filter_commission']}}
                            </td>
                            <td>
                                {!! date('d/M/Y', strtotime($start_date)) !!}
                            </td>
                            <td>
                            {!! date('d/M/Y', strtotime($end_date)) !!}
                            </td>
                          </tr>
                      @endforeach
                  </tbody>
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