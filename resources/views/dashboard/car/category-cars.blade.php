
@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="example">
      <div class="row">
      @foreach($cars_details as $details)
            <div class="col-12 col-md-6 col-xl-4">
            <div class="card">
                <img style="height: 250px;" src="{{asset($details['image']->image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                <h4 class="card-title">اسم السيارة : {{$details['car']->name}}</h4>
                <h5 class="card-title">{{__('مزود الخدمة')}} : {{$details['provider']->name}}</h5>
                <h5 class="card-title">{{__('نوع السيارة')}} : {{$details['type']->type}}</h5>
                <a  title="{{__('تعديل السيارة')}}" href="/admin/editCar/{{$details['car']->id}}"> <i data-feather="edit"></i></i></a>
                <a  title="{{__('حذف السيارة')}}" href="/admin/removeCar/{{$details['car']->id}}"> <i data-feather="trash"></i></i></a>
                </div>
            </div>
            </div>
            @endforeach
      </div>
    </div>
    @endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush
