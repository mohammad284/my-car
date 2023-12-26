@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@section('content')


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{__('طلبات مزودي الخدمة')}}</h4>
        <h6 class="card-title">{{__('يوجد عدد (10) شركات ترغب بالانضمام')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الاسم')}}</th>
                <th>{{__('الأيميل')}}</th>
                <th>{{__('الهاتف')}}</th>
                <th>{{__('اسم الشركة')}}</th>
                <th>{{__('شعار الشركة')}}</th>
                <th>{{__('الدولة')}}</th>
                <th>{{__('المدينة')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($providers as $provider)
                <tr>
                    <td>{{$provider->name}}</td>
                    <td>{{$provider->email}}</td>
                    <td>{{$provider->mobile}}</td>
                    <td>{{$provider->company_name}}</td>
                    <td><img src="{{asset($provider->company_icon)}}"></td>@if($provider['countries'] == null)
                    <td></td>@else <td>{{$provider['countries']->country}}</td>@endif
                    @if($provider['cities'] == null)<td></td>@else
                    <td>{{$provider['cities']->city}}</td>@endif
                    <td class="action"> 
                        <a type="button"  title="{{__('قبول')}}" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$provider->id}}"> <i data-feather="check-square"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/admin/blockProvider/{{$provider->id}}"><i data-feather="slash"></i></i></a>
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
@foreach($providers as $provider)
      <div class="modal fade" id="exampleModal-{{$provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('أضف نسبة الربح من المزود')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" enctype="multipart/form-data" action="/admin/acceptUser/{{$provider->id}}">
                @csrf
                <div class="mb-3">
                  <label for="recipient-name" class="form-label">{{__('نسبة الربح')}} %:</label>
                  <input type="number" class="form-control" name="percentage" min="1" max="99" id="exampleInputNumber1" value="{{$provider->percentage}}" required>
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
<script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
<script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush