@extends('dashboard.layout.master')
@push('plugin-styles')
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
<!-- Message -->
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
<!-- ./Message -->
    <div class="example">
      <div class="row">
      <a type="button" href="/admin/addCarType" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
        <i class="btn-icon-prepend" ></i>
        {{__('إضافة تصنيف جديد')}}
      </a>
      @foreach($type_details as $type)
            <div class="col-12 col-md-6 col-xl-4">
            <div class="card">
                <a  href="/admin/categoryCars/{{$type['type']->id}}"><img style="height: 250px;" src="{{asset($type['type']->image)}}" title ="{{__('سيارات هذا التصنيف')}}" class="card-img-top" alt="..."></a>
                <div class="card-body">
                <h4 class="card-title">{{$type['type']->type}}</h4>
                <h5 class="card-title">{{__('عدد السيارات')}}:{{$type['car_number']}}</h5>
                <a  title="{{__('تعديل التصنيف')}}" href="/admin/editCarType/{{$type['type']->id}}"> <i data-feather="edit"></i></i></a>
                <a href="/admin/categoryCars/{{$type['type']->id}}" class="btn btn-primary">{{__('سيارات هذا التصنيف')}}</a>
                <a  title="{{__('حذف التصنيف')}}" href="/admin/removeCarType/{{$type['type']->id}}"> <i data-feather="trash"></i></i></a>
                </div>
            </div>
            </div>
            @endforeach
      </div>
    </div>
    
    @endsection
	<!-- Message -->
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush


