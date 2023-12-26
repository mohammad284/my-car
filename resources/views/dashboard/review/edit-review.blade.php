@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@section('content')



<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"></h6>
        <p class="text-muted mb-3">{{__('تعديل التقييم')}}</p>
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateReview/{{$review->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('المستخدم')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="rate" value="{{$user->name}}" disabled required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('التعليق')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="comment" value="{{$review->comment}}" required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('التقييم')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="rate" value="{{$review->rate}}" disabled required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم السيارة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="rate" value="{{$car->name}}" disabled required/>
                </div>

            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
