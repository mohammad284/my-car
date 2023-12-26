<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\CarType;
use App\Models\Booking;
use App\Models\Notification;
use PDF;
use Carbon\Carbon;
class FinancialReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //
    public function autoReports(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        
        $providers = User::where('type','provider')->get();
        $date = now();
        
        $cars_details = [];
        foreach($providers as $provider){
            $cars = Car::where('provider_name',$provider->id)->where('lan',$lan)->get();
            $tolal_car = count($cars);
            $to = $date;
            $from = now()->subDays(7);
            $month = now()->subDays(30);
            $today_booking = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();
            $week_booking  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();            
            $month_booking  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();            
            
            $today_booking = count($today_booking);
            $week_booking = count($week_booking);
            $month_booking = count($month_booking);

            $final = array('total_car'=>$tolal_car,'provider'=>$provider ,'today_booking'=>$today_booking ,'week_booking'=>$week_booking,'month_booking'=>$month_booking,'from'=>$from,'month'=>$month);
            array_push($cars_details , $final);
        }
        
        $to = $date;
        $from = now()->subDays(7);
        $week_booking = Booking::whereBetween('created_at', [$from, $to])->get();

        return view('dashboard.financial-reports.cars-reports',compact('cars_details','date','notifications','status_notification'));
    }
    // 
    public function financialReports(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $date = now();
        $providers = User::where('type','provider')->get();
        $commission_details = [];
        foreach($providers as $provider){
            
            $to = $date;
            $from = now()->subDays(7);
            $month = now()->subDays(30);
            $today_car = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->get();
            $week_car  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->get();          
            $month_car  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->get();
            $today_cars = count($today_car);
            $week_cars = count($week_car);
            $month_cars = count($month_car);
            $today_commission = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->sum('price');
            $week_commission  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->sum('price');           
            $month_commission  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->sum('price');
            $final = array('provider'=>$provider , 'today_commission'=>$today_commission,'week_commission'=>$week_commission ,'month_commission'=>$month_commission,'today_cars'=>$today_cars,'week_cars'=>$week_cars,'month_cars'=>$month_cars,'from'=>$from,'month'=>$month);
            array_push($commission_details , $final);
            // dd($final);
        }
        return view('dashboard.financial-reports.financial-reports',compact('commission_details','date','notifications','status_notification'));
    }
    //
    public function autoDetailstoday($provider_id){
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
        $today_car = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider_id)->where('status','waiting')->orWhere('status','prossing')->whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider_id)->get();
        $booking_details =[];
        foreach($today_car as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $car_type = CarType::where('id',$car->type)->first();
            $user = User::where('id',$booking->user_id)->first();
            $final = array('booking'=>$booking , 'car'=>$car ,'car_type'=>$car_type,'user'=>$user);
            array_push($booking_details , $final);
        }
        return view('dashboard.financial-reports.more-details',compact('booking_details','notifications','status_notification'));
    }
    //
    public function autoDetailsweek($provider_id){
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
        $from = now()->subDays(7);
        $week_booking  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider_id)->where('status','waiting')->orWhere('status','prossing')->whereBetween('created_at', [$from, $to])->where('provider_id',$provider_id)->get(); 
        $booking_details =[];
        foreach($week_booking as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $car_type = CarType::where('id',$car->type)->first();
            $user = User::where('id',$booking->user_id)->first();
            $final = array('booking'=>$booking , 'car'=>$car ,'car_type'=>$car_type,'user'=>$user);
            array_push($booking_details , $final);
        }
        return view('dashboard.financial-reports.more-details',compact('booking_details','notifications','status_notification'));

    }
    //
    public function autoDetailsMonth($provider_id){
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
        $month = now()->subDays(30);
        $month_booking  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider_id)->where('status','waiting')->orWhere('status','prossing')->whereBetween('created_at', [$month, $to])->where('provider_id',$provider_id)->get(); 
        $booking_details =[];
        foreach($month_booking as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $car_type = CarType::where('id',$car->type)->first();
            $user = User::where('id',$booking->user_id)->first();
            $final = array('booking'=>$booking , 'car'=>$car ,'car_type'=>$car_type,'user'=>$user);
            array_push($booking_details , $final);
        }
        return view('dashboard.financial-reports.more-details',compact('booking_details','notifications','status_notification'));

    }
    //
    public function printTodayCarReport(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        
        $providers = User::where('type','provider')->get();
        $date = now();
        
        $cars_details = [];
        foreach($providers as $provider){
            $cars = Car::where('provider_name',$provider->id)->where('lan',$lan)->get();
            $tolal_car = count($cars);
            $to = $date;
            $from = now()->subDays(7);
            $month = now()->subDays(30);
            $today_booking = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();
            $week_booking  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();            
            $month_booking  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();            
            
            $today_booking = count($today_booking);
            $week_booking = count($week_booking);
            $month_booking = count($month_booking);

            $final = array('total_car'=>$tolal_car,'provider'=>$provider ,'today_booking'=>$today_booking ,'week_booking'=>$week_booking,'month_booking'=>$month_booking);
            array_push($cars_details , $final);
        }
        // share data to view
        view()->share('cars_details',$cars_details);

        $pdf = PDF::loadView('dashboard.financial-reports.today-car-pdf', $cars_details);

        return $pdf->stream('document.pdf');
    }
    //
    public function printWeekCarReport(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        
        $providers = User::where('type','provider')->get();
        $date = now();
        
        $cars_details = [];
        foreach($providers as $provider){
            $cars = Car::where('provider_name',$provider->id)->where('lan',$lan)->get();
            $tolal_car = count($cars);
            $to = $date;
            $from = now()->subDays(7);
            $week_booking  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();            
            
            $week_booking = count($week_booking);

            $final = array('total_car'=>$tolal_car,'provider'=>$provider  ,'week_booking'=>$week_booking);
            array_push($cars_details , $final);
        }
        // share data to view
        view()->share('cars_details',$cars_details);

        $pdf = PDF::loadView('dashboard.financial-reports.week-car-pdf', $cars_details);
        return $pdf->stream('document.pdf');
    }
    //
    public function printMonthCarReport(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        
        $providers = User::where('type','provider')->get();
        $date = now();
        
        $cars_details = [];
        foreach($providers as $provider){
            $cars = Car::where('provider_name',$provider->id)->where('lan',$lan)->get();
            $tolal_car = count($cars);
            $to = $date;
            $from = now()->subDays(7);
            $month = now()->subDays(30);
            $month_booking  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();            
            

            $month_booking = count($month_booking);

            $final = array('total_car'=>$tolal_car,'provider'=>$provider ,'month_booking'=>$month_booking);
            array_push($cars_details , $final);
        }
        // share data to view
        view()->share('cars_details',$cars_details);

        $pdf = PDF::loadView('dashboard.financial-reports.month-car-pdf', $cars_details);
        return $pdf->stream('document.pdf');
    }
    //
    public function printTodayFinancialReport(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $date = now();
        $providers = User::where('type','provider')->get();
        $commission_details = [];
        foreach($providers as $provider){
            
            $to = $date;
            $today_car = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();
            
            $today_cars = count($today_car);

            $today_commission = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->sum('price');
            $final = array('provider'=>$provider , 'today_commission'=>$today_commission,'today_cars'=>$today_cars);
            array_push($commission_details , $final);
        }
                // share data to view
                view()->share('commission_details',$commission_details);

                $pdf = PDF::loadView('dashboard.financial-reports.today-financial-pdf', $commission_details);
                return $pdf->stream('document.pdf');
    }
    //
    public function printWeekFinancialReport(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $date = now();
        $providers = User::where('type','provider')->get();
        $commission_details = [];
        foreach($providers as $provider){
            
            $to = $date;
            $from = now()->subDays(7);
            $month = now()->subDays(30);
            $today_car = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();
            $week_car  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();          
            $month_car  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();
            $today_cars = count($today_car);
            $week_cars = count($week_car);
            $month_cars = count($month_car);
            $today_commission = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->sum('price');
            $week_commission  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->sum('price');           
            $month_commission  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->sum('price');
            $final = array('provider'=>$provider , 'today_commission'=>$today_commission,'week_commission'=>$week_commission ,'month_commission'=>$month_commission,'today_cars'=>$today_cars,'week_cars'=>$week_cars,'month_cars'=>$month_cars);
            array_push($commission_details , $final);
        }
        // share data to view
        view()->share('commission_details',$commission_details);

        $pdf = PDF::loadView('dashboard.financial-reports.week-financial-pdf', $commission_details);
        return $pdf->stream('document.pdf');
    }
    //
    public function printMonthFinancialReport(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $date = now();
        $providers = User::where('type','provider')->get();
        $commission_details = [];
        foreach($providers as $provider){
            
            $to = $date;
            $from = now()->subDays(7);
            $month = now()->subDays(30);
            $today_car = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();
            $week_car  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();          
            $month_car  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->get();
            $today_cars = count($today_car);
            $week_cars = count($week_car);
            $month_cars = count($month_car);
            $today_commission = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->sum('price');
            $week_commission  = Booking::whereBetween('created_at', [$from, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->sum('price');           
            $month_commission  = Booking::whereBetween('created_at', [$month, $to])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->sum('price');
            $final = array('provider'=>$provider , 'today_commission'=>$today_commission,'week_commission'=>$week_commission ,'month_commission'=>$month_commission,'today_cars'=>$today_cars,'week_cars'=>$week_cars,'month_cars'=>$month_cars);
            array_push($commission_details , $final);
        }
        // share data to view
        view()->share('commission_details',$commission_details);

        $pdf = PDF::loadView('dashboard.financial-reports.month-financial-pdf', $commission_details);
        return $pdf->stream('document.pdf');
    }

    public function carReportFilter(Request $request){
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
        $result_details = [];
        foreach($bookings as $booking){
            $user = User::find($booking->user_id);
            $provider = User::find($booking->provider_id);
            $result_booking  = Booking::whereBetween('created_at', [$start_date, $end_date])->where('provider_id',$provider->id)->where('status','waiting')->orWhere('status','prossing')->count();     
            $total_car = Car::where('provider_name',$provider->id)->where('lan',$lan)->count();
            $final = array('total_car'=>$total_car,'provider'=>$provider ,'result_booking'=>$result_booking);
            array_push($result_details , $final);
        }
        // dd($result_details);
        return view('dashboard.financial-reports.search-car-filter',compact('result_details','notifications','status_notification','start_date','end_date'));
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