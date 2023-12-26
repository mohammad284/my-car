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
        <h6 style="font-size = 20px;" class="card-title">{{__('رسائل اتصل بنا')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الموضوع')}}</th>
                <th>{{__('الرد')}}</th>
                <th>{{__('الاسم')}}</th>
                <th>{{__('البريد الالكتروني')}}</th>
                <th>{{__('الهاتف')}}</th>
                <th>{{__('تاريخ الإرسال')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($messege_details as $details)
                <tr>
                    <td>{{$details['message']->message}}</td>
                    <td>{{$details['message']->reply}}</td>
                    <td>{{$details['user']->name}}</td>
                    <td>{{$details['user']->email}}</td>
                    <td>{{$details['user']->mobile}}</td>
                    <td>{{$details['message']->created_at}}</td>
                    <td class="action"> 
               
                        <a  title="{{__('حذف')}}" href="/admin/deleteMessage/{{$details['message']->id}}"><i data-feather="trash"></i></i></a>
                        <a type="button"  title="{{__('رد')}}" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$details['message']->id}}"> <i class="mdi mdi-reply"></i></a>
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
@foreach($messege_details as $details)
      <div class="modal fade" id="exampleModal-{{$details['message']->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('الرد على الرسالة')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" enctype="multipart/form-data" action="/admin/replyMessage/{{$details['message']->id}}">
                @csrf
                <div class="mb-3">
                  <label for="recipient-name" class="form-label">{{__('نص الرسالة')}} :</label>
                  <textarea  style="height: 150px;" class="form-control" id="text" name="reply" required></textarea>
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
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush