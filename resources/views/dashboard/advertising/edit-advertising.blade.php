

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
<h4 id="default">{{__('تعديل إعلان')}}</h4>
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

        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateAdvertising/{{$advertising_ar->id}}">
            @csrf
            <div class="row mb-6">

            <div class="row mb-3">
                <div class="col">
                <label class="form-label">{{__('النص')}}:</label>
                <textarea  class="form-control" id="text" name="text_ar" required>{{$advertising_ar->text}}</textarea>
                </div>
            </div>
            <div class="row mb-6">
              <div class="col-md-6">
                <label class="form-label"> {{__('لون الخلفية')}} </label>
                <p class="text-muted mb-3">{{__('الرجاء إختيار لون الخلفية مناسب للون السيارة')}}</p>
                <div id="cp1" class="input-group mb-2" title="Using input value">
                  <input type="text" class="form-control" name="bg_color" value="{{$advertising_ar->bg_color}}" required/>
                  <span class="input-group-text colorpicker-input-addon"><i></i></span>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('لون الخط')}} </label>
                <p class="text-muted mb-3">{{__('الرجاء إختيار لون الخط مناسب للون الخلفية')}}</p>
                <div id="cp1" class="input-group mb-2" title="Using input value">
                  <input type="text" class="form-control" name="font_color" value="{{$advertising_ar->font_color}}" required/>
                  <span class="input-group-text colorpicker-input-addon"><i></i></span>
                </div>
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
                <label for="provider_car"  class="form-label">{{__('حدد مزود الخدمة')}}</label>
                <select class="form-select" id="provider_car" name="provider_car"  required>
                  <option selected="" value="" disabled>{{__('حدد مزود الخدمة')}}</option>
                  @foreach($providers as $provider)
                      <option value='{{ $provider->id }}'>{{$provider->name}}</option>
                    @endforeach 
                </select>
              </div>
              <div class="col-md-6">
                <label  class="form-label">{{__('اختار السيارة المراد عرض الإعلان عنها')}}</label>
                <select class="form-select" name="car_id" id="car_id" required>
                  <option selected disabled>{{__('اختار السيارة المراد عرض الإعلان عنها')}}</option>
                  @foreach($cars as $car)
                      <option value='{{ $car->id }}'>{{$car->name}}</option>
                    @endforeach 
                </select>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6 stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{__('الصورة')}}</h6>
                        <input type="file" id="myDropify" name="image" required/>
                    </div>
                    </div>
                </div>
            </div>
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

            <div class="row mb-6">

            <div class="row mb-3">
                <div class="col">
                <label class="form-label">{{__('النص')}}:</label>
                <textarea  class="form-control" id="text" name="text_en" required>{{$advertising_en->text}}</textarea>
                </div>
            </div>
            <div class="row mb-6">
              <div class="col-md-6">
                <label class="form-label"> {{__('لون الخلفية')}} </label>
                <p class="text-muted mb-3">{{__('الرجاء إختيار لون الخلفية مناسب للون السيارة')}}</p>
                <div id="cp1" class="input-group mb-2" title="Using input value">
                  <input type="text" class="form-control" name="bg_color" value="{{$advertising_en->bg_color}}" disabled/>
                  <span class="input-group-text colorpicker-input-addon"><i></i></span>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label"> {{__('لون الخط')}} </label>
                <p class="text-muted mb-3">{{__('الرجاء إختيار لون الخط مناسب للون الخلفية')}}</p>
                <div id="cp1" class="input-group mb-2" title="Using input value">
                  <input type="text" class="form-control" name="font_color" value="{{$advertising_en->font_color}}" disabled/>
                  <span class="input-group-text colorpicker-input-addon"><i></i></span>
                </div>
              </div>
              <div >
                <br>
              </div>
              <div class="col-md-6">
                <label for="provider_car"  class="form-label">{{__('حدد مزود الخدمة')}}</label>
                <select class="form-select" id="provider_car" name="provider_car"  disabled>
                  <option selected="" value="" disabled>{{__('حدد مزود الخدمة')}}</option>
                  @foreach($providers as $provider)
                      <option value='{{ $provider->id }}'>{{$provider->name}}</option>
                    @endforeach 
                </select>
              </div>
              <div class="col-md-6">
                <label  class="form-label">{{__('اختار السيارة المراد عرض الإعلان عنها')}}</label>
                <select class="form-select" name="car_id" id="car_id" disabled>
                  <option selected disabled>{{__('اختار السيارة المراد عرض الإعلان عنها')}}</option>
                  @foreach($cars as $car)
                      <option value='{{ $car->id }}'>{{$car->name}}</option>
                    @endforeach 
                </select>
              </div>
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
    $('#provider_car').change(function(){
        val = $('#provider_car').val();
        $.ajax({
            url: "{{route('change_select')}}",          
            data:{
                val:val,
                _token:"{{ csrf_token() }}",
            },
            method: "post",
            success: function(response){                            

                const data = response.provider_cars;
                var html="";
                if (data.length > 0) {                    
                    html+="<option selected='' value='' hidden='' disabled=''>{{__('اختار السيارة المراد عرض الإعلان عنها')}}</option>";
                    for (var i = 0; i < data.length; i++){
                        html+=`<option value="${data[i]['id']}">${data[i]['name']}</option>`;                    
                    }   
                }else{
                    html+="<option selected='' value='' hidden='' disabled=''>{{__('اختار السيارة المراد عرض الإعلان عنها')}}</option>";
                    html+="<option >{{__('لا يوجد معلومات')}} ..</option>";
                }
                $('#car_id').html(html);
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