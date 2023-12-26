@extends('dashboard.layout.master')
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
        <h6 class="card-title">{{__('قائمة المصرح بهم بالدخول إلى اللوحة')}}</h6>
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('إضافة حساب جديد')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الاسم')}}</th>
                <th>{{__('الإيميل')}}</th>
                <th>{{__('نوع الحساب')}}</th>
                <th>{{__('تاريخ الإنشاء')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    @if($admin->type == 'admin')
                    <td>{{__('أدمن')}}</td>
                    @else
                    <td>{{__('محرر')}}</td>
                    @endif
                    <td>{{$admin->created_at}}</td>
                    <td class="action"> 
                    <a  title="{{__('تعديل')}}" href="#" data-bs-toggle="modal" data-bs-target="#admin-{{$admin->id}}"><i data-feather="edit"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/admin/deleteAdmin/{{$admin->id}}"><i data-feather="trash"></i></i></a>
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
              <h5 class="modal-title" id="exampleModalLabel">{{__('إضافة حساب جديد')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addAdmin">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الاسم')}}</label>
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
                <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">{{__('نوع الحساب')}}</label>
                  <select class="form-select" name="type" id="exampleFormControlSelect1" >
                  <option selected disabled>{{__('حدد نوع الحساب')}}</option>
                        <option  value="admin">{{__('أدمن')}}</option>
                        <option  value="editor">{{__('محرر')}}</option>
                  </select>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
            </div>
              
          </div>
        </div>
      </div>

      @foreach($admins as $admin)
<div class="modal fade" id="admin-{{$admin->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('تعديل الأدمن')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateAdmin/{{$admin->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم الأدمن')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name" value="{{$admin->name}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('الإيميل')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$admin->email}}" required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('كلمة المرور')}}</label>
                    <input class="form-control mb-4 mb-md-0" type="password" name="old_password"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('تأكيد كلمة المرور')}}</label>
                    <input class="form-control mb-4 mb-md-0" type="password" name="password"  required/>
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
      @endforeach
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush