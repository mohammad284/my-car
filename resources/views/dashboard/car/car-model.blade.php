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
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
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
        <h6 class="card-title">{{__('جميع الماركات')}}</h6>
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('إضافة ماركة جديدة')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('ماركة السيارة')}}</th>
                <th>{{__('تصنيف السيارة')}}</th>
                <th>{{__('الصورة')}}</th>
                <th>{{__('تاريخ الإنشاء')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($models as $model)
                <tr>
                    <td>{{$model->model}}</td>
                    <td>{{$model['car_type']->type}}</td>
                    <td><img src="{{asset($model->image)}}"></td>
                    <td>{{$model->created_at}}</td>
                    <td class="action"> 
                    <a  title="{{__('تعديل')}}" href="#" data-bs-toggle="modal" data-bs-target="#model-{{$model->id}}"><i data-feather="edit"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/admin/deleteModel/{{$model->id}}"><i data-feather="trash"></i></i></a>
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
              <h5 class="modal-title" id="exampleModalLabel">{{__('إضافة ماركة جديدة')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addModel">
            @csrf

            <div class="row mb-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الماركة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="model"  required/>
              <div >
                <br>
              </div>
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">{{__('نوع السيارة')}}</label>
                  <select class="js-example-basic-single form-select" name="type_id" id="type"  data-width="100%" required>
                  <!-- <select class="form-select" name="type" id="exampleFormControlSelect1" > -->
                    <option selected disabled>{{__('حدد نوع السيارة')}}</option>
                      @foreach($car_types as $type)
                        <option value="{{$type->id}}">{{$type->type}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{__('الصورة')}}</h6>
                        <input type="file" id="myDropify" name="image"  required/>
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

      @foreach($models as $model)
<div class="modal fade" id="model-{{$model->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('تعديل ماركة السيارة')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateModel/{{$model->id}}">
            @csrf

            <div class="row mb-6">
                <label for="exampleInputNumber1" class="form-label">{{__('الماركة')}}</label>
                <input class="form-control mb-4 mb-md-0" name="model" value="{{$model->model}}" required/>
                <div >
                <br>
              </div>
                <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">{{__('نوع السيارة')}}</label>
                  <select class="js-example-basic-single form-select" name="type_id" id="type"  data-width="100%" required>
                  <!-- <select class="form-select" name="type" id="exampleFormControlSelect1" > -->
                    <option selected disabled>{{__('حدد نوع السيارة')}}</option>
                      @foreach($car_types as $type)
                        <option value="{{$type->id}}">{{$type->type}}</option>
                      @endforeach 
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{__('الصورة')}}</h6>
                        <input type="file" id="myDropif" name="image" />
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
      @endforeach
@endsection
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