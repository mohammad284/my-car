@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@section('content')


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('المراجعات')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('اسم السيارة')}}</th>
                <th>{{__('اسم المزود')}}</th>
                <th>{{__('التقييم')}}</th>
                <th> {{__('التعليق')}}</th>
                <th>{{__('التاريخ')}}</th>@if(Auth::guard('admin')->check())
                <th>{{__('تعديل')}}</th>@endif
              </tr>
            </thead>
            <tbody>
                @foreach($reviews_details as $review)
                <tr>
                    <td>{{$review['car']->name}}</td>
                    @if (Auth::user()->type == 'admin')
                    <td><a href="/admin/moreDetails/{{$review['user']->id}}" >{{$review['user']->name}}</a></td>
                    @else
                    <td>{{$review['user']->name}}</td>
                    @endif
                    
                    <td>{{$review['review']->rate}}</td>
                    <td>{{$review['review']->comment}}</td>
                    <td>{{$review['review']->created_at}}</td>@if(Auth::guard('admin')->check())
                    <td class="action"> 
                            <a  title="{{__('تعديل')}}" href="/admin/ediReview/{{$review['review']->id}}"> <i data-feather="edit"></i></i></a>
                        </td>@endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
