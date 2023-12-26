<?php

namespace App\Http\Controllers\Provider;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\User;
    use App\Models\Car;
    use App\Models\CarType;
    use App\Models\Booking;
    use App\Models\Color;
    use App\Models\Notification;
    use PDF;
    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;
class ReportProviderController extends Controller
{

    public function financialReports(){
        $provider_id = Auth::user()->id;
        $provider = User::find($provider_id);
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $date = now();
        $to = $date;
        $today_car = Booking::where('provider_id',$provider_id)->where('status','waiting')->orWhere('status','prossing')->where('provider_id',$provider_id)->get();
        $booking_details =[];
        foreach($today_car as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $car_type = CarType::where('id',$car->type)->first();
            $user = User::where('id',$booking->user_id)->first();
            $color   = Color::where('id',$car->color_id)->first();
            $final = array('booking'=>$booking , 'car'=>$car ,'car_type'=>$car_type,'user'=>$user,'color'=>$color);
            array_push($booking_details , $final);
        }
        return view('dashboard.financial-reports.provider-financial',compact('booking_details','notifications','status_notification'));
    }
    //
    public function autoDetails(){
        $provider_id = Auth::user()->id;
        $provider = User::find($provider_id);
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $date = now();
        $to = $date;
        $today_car = Booking::where('provider_id',$provider_id)->where('status','waiting')->orWhere('status','prossing')->where('provider_id',$provider_id)->get();
        $booking_details =[];
        foreach($today_car as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $car_type = CarType::where('id',$car->type)->first();
            $user = User::where('id',$booking->user_id)->first();
            $color   = Color::where('id',$car->color_id)->first();
            $final = array('booking'=>$booking , 'car'=>$car ,'car_type'=>$car_type,'user'=>$user,'color'=>$color);
            array_push($booking_details , $final);
        }
        return view('dashboard.financial-reports.more-details',compact('booking_details','notifications','status_notification'));
    }
    //

    public function carReportFilter(Request $request){
        $provider_id = Auth::user()->id;
        $provider = User::find($provider_id);
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $date = now();
        $to = $date;
        $start_date =$request->start ;
        $end_date   = $request->end;
        $today_car = Booking::whereBetween('created_at', [$start_date ,$end_date])->where('provider_id',$provider_id)->where('status','waiting')->orWhere('status','prossing')->whereBetween('created_at', [$start_date ,$end_date])->where('provider_id',$provider_id)->get();
        $booking_details =[];
        foreach($today_car as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $car_type = CarType::where('id',$car->type)->first();
            $user = User::where('id',$booking->user_id)->first();
            $color   = Color::where('id',$car->color_id)->first();
            $final = array('booking'=>$booking , 'car'=>$car ,'car_type'=>$car_type,'user'=>$user,'color'=>$color);
            array_push($booking_details , $final);
        }
        return view('dashboard.financial-reports.more-details',compact('booking_details','notifications','status_notification'));

    }
    public function financialFilter(Request $request){
        $provider_id = Auth::user()->id;
        $provider = User::find($provider_id);
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $date = now();
        $to = $date;
        $start_date =$request->start ;
        $end_date   = $request->end;
        $today_car = Booking::whereBetween('created_at', [$start_date ,$end_date])->where('provider_id',$provider_id)->where('status','waiting')->orWhere('status','prossing')->whereBetween('created_at', [$start_date ,$end_date])->where('provider_id',$provider_id)->get();
        $booking_details =[];
        foreach($today_car as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $car_type = CarType::where('id',$car->type)->first();
            $user = User::where('id',$booking->user_id)->first();
            $color   = Color::where('id',$car->color_id)->first();
            $final = array('booking'=>$booking , 'car'=>$car ,'car_type'=>$car_type,'user'=>$user,'color'=>$color);
            array_push($booking_details , $final);
        }
        return view('dashboard.financial-reports.provider-financial',compact('booking_details','notifications','status_notification'));

    }
    public function financialReportFilter(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $start_date =$request->start ;
        $end_date   = $request->end;
        $bookings = Booking::whereBetween('created_at', [$start_date ,$end_date])->get();

        $providers = User::where('type','provider')->get();
        $filter_details = [];
        foreach($providers as $provider){
            $bookings = Booking::whereBetween('created_at', [$start_date ,$end_date])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();

            $filter_cars = count($bookings);
         
            $filter_commission  = Booking::whereBetween('created_at', [$start_date, $end_date])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->sum('price');
            $final = array('provider'=>$provider ,'filter_commission'=>$filter_commission,'filter_cars'=>$filter_cars);
            array_push($filter_details , $final);
        }
        return view('dashboard.financial-reports.search-financial-filter',compact('filter_details','notifications','status_notification','start_date','end_date'));
    }
    public function printfilterCarReport(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        
        $providers = User::where('type','provider')->get();
        $start_date = $request->start;
        $end_date   = $request->end;

        $cars_details = [];
        foreach($providers as $provider){
            $cars = Car::where('provider_name',$provider->id)->where('lan',$lan)->get();
            $tolal_car = count($cars);

            $filter_booking  = Booking::whereBetween('created_at', [$start_date, $end_date])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->count();            
            

            $final = array('total_car'=>$tolal_car,'provider'=>$provider ,'filter_booking'=>$filter_booking,'start_date'=>$start_date,'end_date'=>$end_date);
            array_push($cars_details , $final);
        }
        // dd($cars_details);
        // share data to view
        view()->share('cars_details',$cars_details);

        $pdf = PDF::loadView('dashboard.financial-reports.filter-car-pdf', $cars_details);
        return $pdf->stream('document.pdf');
    }
    public function printfilterFinancialReport(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $start_date = $request->start;
        $end_date   = $request->end;
        $providers = User::where('type','provider')->get();
        $commission_details = [];
        foreach($providers as $provider){
            
         
            $month_cars  = Booking::whereBetween('created_at', [$start_date, $end_date])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->count();
      
            $month_commission  = Booking::whereBetween('created_at', [$start_date, $end_date])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->sum('price');
            $final = array('provider'=>$provider ,'month_commission'=>$month_commission,'month_cars'=>$month_cars,'start_date'=>$start_date,'end_date'=>$end_date);
            array_push($commission_details , $final);
        }
        // share data to view
        view()->share('commission_details',$commission_details);

        $pdf = PDF::loadView('dashboard.financial-reports.filter-financial-pdf', $commission_details);
        return $pdf->stream('document.pdf');
    }
}
