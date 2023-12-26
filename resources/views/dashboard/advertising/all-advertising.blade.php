

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
<!-- Message -->
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
<!-- ./Message -->
@section('content')
    <div class="example">
      <div class="row">@if(Auth::guard('admin')->check())
      <a type="button" href="/admin/addAdvirtising" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
        <i class="btn-icon-prepend" ></i>
        {{__('إضافة إعلان جديد')}}       
      </a>@endif
      @foreach($ad_details as $advertising)
            <div class="col-12 col-md-6 col-xl-4">
            <div class="card">
                <img style="height: 270px;" src="{{asset($advertising['advertising']->image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                <h4 class="card-title">{{$advertising['car']->name}}</h4>
                <h5 style="height: 85px;" class="card-title">{{$advertising['advertising']->text}}</h5>@if(Auth::guard('admin')->check())
                <a  title="{{__('تعديل الاعلان')}}" href="/admin/editAdvertising/{{$advertising['advertising']->id}}"> <i data-feather="edit"></i></i></a>
                <a  title="{{__('حذف الإعلان')}}" href="/admin/removeAdvertising/{{$advertising['advertising']->id}}"> <i data-feather="trash"></i></i></a>@endif
                <span class="badge bg-success" style="background-color:{{$advertising['advertising']->bg_color}}; margin-right:60%;">B G</span>
                <span class="badge bg-success" style="background-color:{{$advertising['advertising']->font_color}}; margin-right:0%;" >font</span>
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
