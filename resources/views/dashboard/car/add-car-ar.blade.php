@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<h4 id="default">{{__('إضافة سيارة جديدة')}}</h4>
    <div class="example">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">{{__('عربي')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false">{{__('إنكليزي')}}</a>
        </li>

      </ul>
      <div class="tab-content border border-top-0 p-3" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
            @if(Auth::guard('admin')->check())
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/storeCar">@else
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/provider/storeCar">
          @endif
            @csrf
            <div class="row mb-6">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">{{__('نوع السيارة')}}</label>
                  <select class="js-example-basic-single form-select" name="type" id="type"  data-width="100%" required>
                  <!-- <select class="form-select" name="type" id="exampleFormControlSelect1" > -->
                    <option selected disabled>{{__('حدد نوع السيارة')}}</option>
                      @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->type}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>
            <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">{{__('ماركة السيارة')}}</label>
                  <select class="js-example-basic-single form-select" name="name_ar" id="name_ar"  data-width="100%" required>
                    <option selected disabled>{{__('حدد ماركة السيارة')}}</option>
                      @foreach($models as $model)
                        <option value="{{$model->model}}">{{$model->model}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>
              <div >
                <br>
              </div>
              @if(Auth::guard('admin')->check())
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">{{__('مزود الخدمة')}}</label>
                  <select class="js-example-basic-single form-select" name="provider_name" id="exampleFormControlSelect"  data-width="100%" required>
                  <!-- <select class="form-select" name="provider_name" id="exampleFormControlSelect1" > -->
                    <option selected disabled>{{__('حدد مزود الخدمة')}}</option>
                      @foreach($providers as $provider)
                        <option value="{{$provider->id}}">{{$provider->email}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>@endif
              <div class="col-md-6">
                <label class="form-label"> {{__('رقم السيارة')}}</label>
                <input class="form-control mb-4 mb-md-0" name="number_of_car_ar" required/>
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
                <label class="form-label">{{__('المواصفات')}}</label>
                <textarea  class="form-control" id="text" name="specification_ar" required></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">{{__('معلومات هامة')}}</label>
                <textarea  class="form-control" id="text" name="important_information_ar" required></textarea>
              </div>
              <div >
                <br>
              </div>

              <div class="col-md-6">
                <label class="form-label">{{__('سنة الصنع')}}</label>
                <input class="form-control mb-4 mb-md-0" name="manufacturing" required/>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('مبلغ التأمين')}}</label>
                <input class="form-control mb-4 mb-md-0" name="security_deposit" required/>
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('مستوى الوقود')}} </label>
                <input class="form-control mb-4 mb-md-0" name="fuel_policy_ar" required/>
              </div>

              <div class="col-md-6">
                <label class="form-label"> {{__('عدد الكيلومترات')}}  </label>
                <input class="form-control mb-4 mb-md-0" name="mileage" required/>
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('معلومات اضافية')}}  </label>
                <textarea  class="form-control" id="text" name="extra_information_ar" required></textarea>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleInputNumber1" class="form-label">{{__('عدد المقاعد')}}</label>
                  <input type="number" class="form-control" name="site" min="1" id="exampleInputNumber1" value="1" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputNumber1" class="form-label">{{__('عدد الابواب')}}</label>
                    <input type="number" class="form-control" name="door" min="1"  id="exampleInputNumber1" value="1" required>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('لون السيارة')}} </label>
                <select class="js-example-basic-single form-select" id="font_color" name="color"  data-width="100%" required>
                  <option selected="" value="" disabled>{{__('لون السيارة')}}</option>
                  @foreach($colors as $color)
                      <option value='{{ $color->id }}'>{{$color->color_ar}}</option>
                    @endforeach 
                </select>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputNumber1" class="form-label">{{__('الضرر الزائد')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="damage_excess_ar" required/>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('السعر ليوم واحد')}}</label>
                <input class="form-control mb-4 mb-md-0" name="price_for_day" required/>
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('السعر لمدة أسبوع')}} </label>
                <input class="form-control mb-4 mb-md-0" name="weekly_price" required/>
              </div>

              <div class="col-md-6">
                <label class="form-label"> {{__('السعر لمدة شهر')}}  </label>
                <input class="form-control mb-4 mb-md-0" name="monthly_price" required />
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                <label for="exampleInputNumber1" class="form-label">{{__('حدد الدولة')}}</label>
                <select class="js-example-basic-single form-select" id="country_id" name="country_id"  data-width="100%" required>
                    <option selected disabled>{{__('حدد الدولة')}}</option>
                      @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->country}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                <label for="exampleInputNumber1" class="form-label">{{__('حدد المدينة')}}</label>
                <select class="js-example-basic-single form-select" id="city_id" name="city_id"  data-width="100%" required>
                    <option selected disabled>{{__('حدد المدينة')}}</option>
                      @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('ناقل الحركة')}} </label>
                <div class="mb-3">
                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" value="1" name="automatic" id="radioInline" required>
                    <label class="form-check-label" for="radioInline">
          {{__('أتوماتيكي')}}                     
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" value="0" name="automatic" id="radioInline" required>
                    <label class="form-check-label" for="radioInline">
                      {{__('يدوي')}}                    
                    </label>
                  </div>
                </div>
                </div>


            </div>
            @if(Auth::guard('admin')->check())
            <div class="row">
                <div class="col-md-6 stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{__('الصورة')}}</h6>
                        <input type="file" id="myDropify" name="image[]" multiple="multiple" required/>
                    </div>
                    </div>
                </div>
            </div>@endif
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

            <div class="row mb-6">

            <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">{{__('ماركة السيارة')}}</label>
                  <select class="form-select" name="name_en" id="exampleFormControlSelect1" >
                    <option selected >{{__('حدد ماركة السيارة')}}</option>
                      @foreach($models as $model)
                        <option disabled value="{{$model->model}}">{{$model->model}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label">{{__('رقم السيارة')}}</label>
                <input class="form-control mb-4 mb-md-0" name="number_of_car_en" required/>
              </div>
              <div >
                <br>
              </div>
              @if(Auth::guard('admin')->check())
              <div class="col-md-6">
                <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">{{__('مزود الخدمة')}}</label>
                  <select class="form-select" name="provider_name" id="exampleFormControlSelect1" >
                  <option selected disabled>{{__('حدد مزود الخدمة')}}</option>
                      @foreach($providers as $provider)
                        <option disabled value="{{$provider->id}}">{{$provider->email}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>@endif
              <div class="col-md-6">
                <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">{{__('نوع السيارة')}}</label>
                  <select class="form-select" name="type" id="exampleFormControlSelect1" >
                  <option selected disabled>{{__('حدد نوع السيارة')}}</option>
                      @foreach($types as $type)
                        <option disabled value="{{$type->id}}">{{$type->type}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
              <label class="form-label">{{__('المواصفات')}}</label>
                <textarea  class="form-control" id="text" name="specification_en" required></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">{{__('معلومات هامة')}}</label>
                <textarea  class="form-control" id="text" name="important_information_en" required></textarea>
              </div>
              <div >
                <br>
              </div>

              <div class="col-md-6">
              <label class="form-label">{{__('موقع السيارة')}}</label>
                <input class="form-control mb-4 mb-md-0" name="car_location" disabled />
              </div>

              <div class="col-md-6">
                <label class="form-label"> {{__('مبلغ التأمين')}}</label>
                <input class="form-control mb-4 mb-md-0" name="security_deposit" disabled />
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('مستوى الوقود')}} </label>
                <input class="form-control mb-4 mb-md-0" name="fuel_policy_en" required/>
              </div>

              <div class="col-md-6">
                <label class="form-label"> {{__('عدد الكيلومترات')}}  </label>
                <input class="form-control mb-4 mb-md-0" name="mileage" disabled />
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('معلومات اضافية')}}  </label>
                <textarea  class="form-control" id="text" name="extra_information_en" required></textarea>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                <label for="exampleInputNumber1" class="form-label">{{__('عدد المقاعد')}}</label>
                  <input type="number" class="form-control" name="site" min="1" id="exampleInputNumber1" value="1" disabled >
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                <label for="exampleInputNumber1" class="form-label">{{__('عدد الابواب')}}</label>
                    <input type="number" class="form-control" name="door" min="1"  id="exampleInputNumber1" value="1" disabled >
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('لون السيارة')}} </label>
                <select class="js-example-basic-single form-select" id="" name="color"  data-width="100%" disabled>
                  <option selected="" value="" disabled>{{__('لون السيارة')}}</option>
                  @foreach($colors as $color)
                      <option value='{{ $color->id }}'>{{$color->color_ar}}</option>
                    @endforeach 
                </select>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                <label for="exampleInputNumber1" class="form-label">{{__('الضرر الزائد')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="damage_excess_en" required/>
                </div>
              </div>
              <div class="col-md-6">
              <label class="form-label"> {{__('السعر ليوم واحد')}}</label>
                <input class="form-control mb-4 mb-md-0" name="price_for_day" disabled />
              </div>
              <div >
                <br>
              </div>


        </div>
    </div>
    
        </div>

        </div>

      </div>
    </div>
    <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
          </div>
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script>    
    $('#type').change(function(){
        val = $('#type').val();
        $.ajax({
            url: "/provider/changebrand",          
            data:{
                val:val,
                _token:"{{ csrf_token() }}",
            },
            method: "post",
            success: function(response){                            

                const data = response.brand;
                var html="";
                if (data.length > 0) {                    
                    html+="<option selected='' value='' hidden='' disabled=''>{{__('حدد ماركة السيارة')}}</option>";
                    for (var i = 0; i < data.length; i++){
                        html+=`<option value="${data[i]['id']}">${data[i]['model']}</option>`;                    
                    }   
                }else{
                    html+="<option selected='' value='' hidden='' disabled=''>{{__('حدد ماركة السيارة')}}</option>";
                    html+="<option >{{__('لا يوجد معلومات')}} ..</option>";
                }
                $('#name_ar').html(html);
            }
        });
    });    
</script>
<script>    
    $('#country_id').change(function(){
        val = $('#country_id').val();
        $.ajax({
            url: "/provider/changecity",          
            data:{
                val:val,
                _token:"{{ csrf_token() }}",
            },
            method: "post",
            success: function(response){                            

                const data = response.cities;
                var html="";
                if (data.length > 0) {                    
                    html+="<option selected='' value='' hidden='' disabled=''>{{__('حدد المدينة')}}</option>";
                    for (var i = 0; i < data.length; i++){
                        html+=`<option value="${data[i]['id']}">${data[i]['city']}</option>`;                    
                    }   
                }else{
                    html+="<option selected='' value='' hidden='' disabled=''>{{__('حدد المدينة')}}</option>";
                    html+="<option >{{__('لا يوجد معلومات')}} ..</option>";
                }
                $('#city_id').html(html);
            }
        });
    });    
</script>
@endpush
@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush