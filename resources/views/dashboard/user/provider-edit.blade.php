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
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
@section('content')



<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"></h6>
        <p class="text-muted mb-3">{{__('تعديل مزود الخدمة')}}</p>
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateProvider/{{$provider->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم مزود الخدمة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name" value="{{$provider->name}}"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('الإيميل')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$provider->email}}" required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الهاتف')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="mobile" value="{{$provider->mobile}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('العنوان')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="provider_address" value="{{$provider->provider_address}}"  required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم الشركة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="company_name" value="{{$provider->name}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('رقم السجل التجاري')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="cr_number" value="{{$provider->cr_number}}"  required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('نسبة الأرباح')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="percentage" value="{{$provider->percentage}}"  required/>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('الدولة')}}</label>
                    <select class="form-select" name="country" id="exampleFormControlSelect1" >
                      <option selected disabled>{{__('حدد الدولة')}}</option>
                        @foreach($locations as $location)
                          <option value="{{$location->id}}">{{$location->country}}</option>
                        @endforeach 
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('المدينة')}}</label>
                    <select class="form-select" name="city" id="exampleFormControlSelect1" >
                      <option selected disabled>{{__('حدد المدينة')}}</option>
                        @foreach($cities as $city)
                          <option value="{{$city->id}}">{{$city->city}}</option>
                        @endforeach 
                    </select>
                  </div>
                </div>
                <div >
                <br>
              </div>

            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
