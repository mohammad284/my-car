@extends('dashboard.layout.master')
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
        <h6 style="font-size = 20px;" class="card-title">{{__('الايميلات الترحيبية')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('العنوان')}}</th>
                <th>{{__('الايميل/عربي')}}</th>
                <th>{{__('الايميل/انكليزي')}}</th>
                <th>{{__('تاريخ التعديل')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
            @foreach($welcome_emails as $welcome_email)
                <tr>
                    <td>{{$welcome_email->title}}</td>
                    <td>{{$welcome_email->email_ar}}</td>
                    <td>{{$welcome_email->email_en}}</td>
                    <td>{{$welcome_email->updated_at}}</td>
                    <td class="action"> 
                    <a  title="{{__('تعديل')}}" href="#" data-bs-toggle="modal" data-bs-target="#email-{{$welcome_email->id}}"><i data-feather="edit"></i></i></a>
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
@foreach($welcome_emails as $welcome_email)
    <div class="modal fade" id="email-{{$welcome_email->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('تعديل الايميل')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateEmail/{{$welcome_email->id}}">
            @csrf

            <div class="row mb-6">
                <label for="exampleInputNumber1" class="form-label">{{__('الايميل/عربي')}}</label>
                <textarea  style="height: 150px;" class="form-control" id="text" name="email_ar" required>{{$welcome_email->email_ar}}</textarea>
                <!-- <input class="form-control mb-4 mb-md-0" value="" name="email_ar"  required/> -->
                
                <div >
                    <br>
                </div>

                <label class="form-label">{{__('الايميل/انكليزي')}}</label>
                <textarea  style="height: 150px;" class="form-control" id="text" name="email_en" required>{{$welcome_email->email_en}}</textarea>

            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
            </div>
              
          </div>
        </div>
      </div>
@endforeach
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush