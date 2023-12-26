<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarImage;
use App\Models\User;
use App\Models\CarType;
use App\Models\CustomerReview;
use App\Models\Car;
use App\Models\Booking;
use Validator;
use PDF;
use App\Models\Notification;
class EarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function providerPercentage(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $date = now();
        $providers = User::where('type','provider')->where('status','1')->get();
        $earning_details =[];
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
            $daily_earning   = $provider->percentage * $today_commission/100 ;
            $weekly_earning  = $provider->percentage * $week_commission/100 ;
            $monthly_earning = $provider->percentage * $month_commission/100 ;
            $final = array('provider'=>$provider ,'daily_earning'=>$daily_earning,'weekly_earning'=>$weekly_earning,'monthly_earning'=>$monthly_earning, 'today_commission'=>$today_commission,'week_commission'=>$week_commission ,'month_commission'=>$month_commission,'today_cars'=>$today_cars,'week_cars'=>$week_cars,'month_cars'=>$month_cars);
            array_push($earning_details , $final);
        }
        return view('dashboard.financial-reports.provider-percentage',compact('earning_details','date','notifications','status_notification'));

    }
    public function printTodayProviderEarning(){
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
            $daily_earning   = $provider->percentage * $today_commission/100 ;
            $final = array('provider'=>$provider ,'daily_earning'=>$daily_earning, 'today_commission'=>$today_commission,'today_cars'=>$today_cars);
            array_push($commission_details , $final);
        }
                // share data to view
                view()->share('commission_details',$commission_details);

                $pdf = PDF::loadView('dashboard.financial-reports.today-earning-pdf', $commission_details);
                return $pdf->stream('document.pdf');
    }
    //
    public function printWeekProviderEarning(){
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
            $weekly_earning  = $provider->percentage * $week_commission/100 ;
            $final = array('provider'=>$provider ,'weekly_earning'=>$weekly_earning, 'today_commission'=>$today_commission,'week_commission'=>$week_commission ,'month_commission'=>$month_commission,'today_cars'=>$today_cars,'week_cars'=>$week_cars,'month_cars'=>$month_cars);
            array_push($commission_details , $final);
        }
        // share data to view
        view()->share('commission_details',$commission_details);

        $pdf = PDF::loadView('dashboard.financial-reports.week-earning-pdf', $commission_details);
        return $pdf->stream('document.pdf');
    }
    //
    public function printMonthProviderEarning(){
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
            $monthly_earning = $provider->percentage * $month_commission/100 ;
            $final = array('provider'=>$provider ,'monthly_earning'=>$monthly_earning, 'today_commission'=>$today_commission,'week_commission'=>$week_commission ,'month_commission'=>$month_commission,'today_cars'=>$today_cars,'week_cars'=>$week_cars,'month_cars'=>$month_cars);
            array_push($commission_details , $final);
        }
        // share data to view
        view()->share('commission_details',$commission_details);

        $pdf = PDF::loadView('dashboard.financial-reports.month-earning-pdf', $commission_details);
        return $pdf->stream('document.pdf');
    }
}
