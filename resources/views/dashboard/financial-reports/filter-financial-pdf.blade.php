<!DOCTYPE html >
<html <?php $lan = app()->getLocale(); ?> @if($lan == 'en') dir="ltr" @else($lan == 'ar') dir="rtl" @endif>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}
h2 {
  font-family: arial, sans-serif;
  text-align: center;
}
tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>{{__('تقارير شهرية')}}</h2>

<table>
  <tr>
  <th>#</th>
    <th>{{__('مزود الخدمة')}}</th>
    <th>{{__('اسم الشركة')}}</th>
    <th>{{__('عدد السيارات المؤجرة')}}</th>
    <th> {{__('الأرباح')}}</th>
    <th>
    {{__('من تاريخ')}}
    </th>
    <th>
    {{__('إلى تاريخ')}}
    </th>
  </tr>
  <?php $i = 1 ?>
  @foreach($commission_details as $details)
  <tr>
  <td>{{$i}}</td>
    <td> {{$details['provider']->name}}</td>
    <td> {{$details['provider']->company_name}}</td>
    <td>{{$details['month_cars']}}</td>
    <td>{{$details['month_commission']}}</td>
    <td>
    {!! date('d/M/Y', strtotime($details['start_date'])) !!}
    </td>
    <td>
    {!! date('d/M/Y', strtotime($details['end_date'])) !!}
    </td>
  </tr>
  <?php $i =$i+1 ?>
  @endforeach
  <htmlpagefooter name="page-footer">
      {PAGENO}
  </htmlpagefooter>
</table>

</body>
</html>

