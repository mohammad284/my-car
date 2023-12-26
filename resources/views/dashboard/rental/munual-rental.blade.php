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

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 style="font-size:20px;" class="card-title">{{__('التأجير اليدوي')}}</h6>
        <form class="forms-sample" method="POST" enctype="multipart/form-data" action="/provider/rental">
          @csrf

          <div class="row mb-6">
                 <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم المستأجر')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name"  required/>
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                <label for="exampleInputNumber1" class="form-label">{{__('حدد السيارة')}}</label>
                <select class="js-example-basic-single form-select" id="font_color" name="car_id"  data-width="100%" required>
                    <option selected disabled>{{__('حدد السيارة')}}</option>
                      @foreach($cars as $car)
                        <option value="{{$car->id}}">{{$car->name}}</option>
                      @endforeach 
                  </select>
                </div>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label class="form-label"> {{__('من تاريخ')}}  </label>
                    <input class="date form-control"  name="start_date" type="date">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('إلى تاريخ')}}</label>
                    <input class="date form-control"  name="end_date" type="date">
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
                    <label for="exampleInputNumber1" class="form-label">{{__('السعر')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="price" required/>
                </div>
                
            </div>
                <div >
                <br>
              </div>
          <button class="btn btn-primary" type="submit">{{__('حفظ')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
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