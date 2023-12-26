@extends('dashboard.layout.master')
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
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
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
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('الشركات')}}</h6>
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('أضف شركة جديدة')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('اسم الشركة')}}</th>
                <th>{{__('رقم السجل التجاري')}}</th>
                <th>{{__('الهاتف')}}</th>
                <th>{{__('مقر الشركة')}}</th>
                <th>{{__('شعار الشركة')}}</th>
                <th>{{__('نسبة الأرباح')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($providers as $provider) 
                <tr>
                    <td>{{$provider->company_name}}</td>
                    <td>{{$provider->cr_number}}</td>
                    <td>{{$provider->mobile}}</td>
                    <td>{{$provider->provider_address}}</td>
                    <td><img src="{{asset($provider->company_icon)}}"></td>
                    <td>{{$provider->percentage}}%</td>
                    <td class="action"> 
                        <a  title="{{__('مزيد من التفاصيل')}}" href="/admin/moreDetails/{{$provider->id}}"> <i data-feather="eye"></i></i></a>
                        <a  title="{{__('تجميد')}}" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$provider->id}}"><i data-feather="slash"></i></i></a>
                        <a  title="{{__('تعديل')}}" href="/admin/editProvider/{{$provider->id}}"><i data-feather="edit"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/admin/deleteProvider/{{$provider->id}}"><i data-feather="trash"></i></i></a>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('أضف مزود جديد')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addProvider">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم صاحب الشركة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('الإيميل')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label class="form-label"> {{__('الهاتف')}}  </label>
                    <textarea  class="form-control" id="text" name="mobile" required></textarea>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('العنوان')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="provider_address" required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('كلمة المرور')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="password"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('تأكيد كلمة المرور')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="password_confirmation" required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم الشركة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="company_name"   required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('رقم السجل التجاري')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="cr_number"   required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">{{__('الدولة')}}</label>
                  <select class="form-select" name="country" id="country" >
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
                  <select class="form-select" name="city" id="city" >
                    <option selected disabled>{{__('حدد المدينة')}}</option>
                      @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>
            </div>
              <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{__('شعار الشركة')}}</h6>
                        <input type="file" id="myDropify" name="company_icon" required/>
                    </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
            </div>
              
          </div>
        </div>
      </div>
@endsection
@foreach($providers as $provider)
      <div class="modal fade" id="exampleModal-{{$provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('أضف سبب الحظر')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" enctype="multipart/form-data" action="/admin/blockProvider/{{$provider->id}}">
                @csrf
                <div class="mb-3">
                  <label for="recipient-name" class="form-label">{{__('سبب الحظر')}} :</label>
                  <input type="text" class="form-control" name="reason_block"  required>
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
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script>    
    $('#country').change(function(){
        val = $('#country').val();
        $.ajax({
            url: "{{route('change_city')}}",          
            data:{
                val:val,
                _token:"{{ csrf_token() }}",
            },
            method: "post",
            success: function(response){                            

                const data = response.cities;
                var html="";
                if (data.length > 0) {                    
                    html+="<option  selected disabled>{{__('حدد المدينة')}}</option>";
                    for (var i = 0; i < data.length; i++){
                        html+=`<option value="${data[i]['id']}">${data[i]['city']}</option>`;                    
                    }   
                }else{
                    html+="<option selected='' value='' hidden='' disabled=''>{{__('اختار المدينة')}}</option>";
                    html+="<option >{{__('لا يوجد معلومات')}} ..</option>";
                }
                $('#city').html(html);
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