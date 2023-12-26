@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
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
@section('content')
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('جميع السيارات')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('اسم السيارة')}}</th>
                <th>{{__('رقم السيارة')}}</th>
                <th>{{__('نوع السيارة')}}</th>
                <th>{{__('اسم مزود الخدمة')}}</th>
                <th>{{__('سنة الصنع')}}</th>
                <th>{{__('الدولة')}}</th>
                <th>{{__('المدينة')}}</th>
                <th>{{__('السعر ليوم واحد')}}</th>
                <th>{{__('التقييم')}}</th>
                <th>{{__('اللون')}}</th>
                <th>{{__('عدد المقاعد')}}</th>
                <th>{{__('عدد الابواب')}}</th>
                <th>{{__('الحالة')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($all_cars as $car)
                <tr>
                    <td>{{$car['car']->name}}</td>
                    <td>{{$car['car']->number_of_car}}</td>
                    @if (Auth::user()->type == 'admin')
                    <td><a href="/admin/categoryCars/{{$car['type']->id}}" >{{$car['type']->type}}</a></td>
                    <td><a href="/admin/moreDetails/{{$car['provider']->id}}" >{{$car['provider']->name}}</a></td>
                    @else
                    <td>{{$car['type']->type}}</td>
                    <td>{{$car['provider']->name}}</td>
                    @endif
                    <td>{{$car['car']->manufacturing}}</td>
                    <td>{{$car['country']->country}}</td>
                    <td>{{$car['city']->city}}</td>
                    <td>{{$car['car']->price_for_day}}</td>
                    <td>{{$car['car']->rating}}</td>@if($lang == 'ar')
                    <td>{{$car['color']->color_ar}}</td>@else <td>{{$car['color']->color_en}}</td>@endif
                    <td>{{$car['car']->site}}</td>
                    <td>{{$car['car']->door}}</td>@if($car['car']->available == '1')
                    <td>{{__('متوفرة')}}</td>@else<td>{{__('غير متوفرة')}}</td>@endif
                    <td class="action"> @if(Auth::guard('admin')->check())
                        <!-- <a  title="{{__('مزيد من التفاصيل')}}" href="/admin/moreDetails/{{$car['car']->id}}"> <i data-feather="eye"></i></i></a> -->
                        <a  title="{{__('تعديل')}}" href="/admin/editCar/{{$car['car']->id}}"><i data-feather="edit"></i></i></a>@if($car['car']->available == '1')
                        <a  title="{{__('عدم تفعيل')}}" type="button" href="/admin/activeCar/{{$car['car']->id}}">{{__('عدم تفعيل')}}</a>@else<a  title="{{__('تفعيل')}}" type="button" href="/admin/activeCar/{{$car['car']->id}}">{{__('تفعيل')}}</a>@endif
                        <a  title="{{__('حذف')}}" href="/admin/removeCar/{{$car['car']->id}}"><i data-feather="trash"></i></i></a>@else
                        <a  title="{{__('تعديل')}}" href="/provider/editCar/{{$car['car']->id}}"><i data-feather="edit"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/provider/removeCar/{{$car['car']->id}}"><i data-feather="trash"></i></i></a>
                        @endif
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
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush