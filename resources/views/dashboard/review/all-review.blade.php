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
        @foreach($cars_details as $car_details)
            <div class="col-12 col-md-6 col-xl-4">
            <div class="card">
                <img  style="height: 250px;" src="{{asset($car_details['image']->image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">{{$car_details['car']->name}}</h5>@if(Auth::guard('admin')->check())
                <a href="/admin/carReview/{{$car_details['car']->id}}" class="btn btn-primary">{{__('المراجعات')}}</a>@else
                <a href="/provider/carReview/{{$car_details['car']->id}}" class="btn btn-primary">{{__('المراجعات')}}</a>@endif
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
