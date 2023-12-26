<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Car;
use App\Models\Advertising;
use Illuminate\Support\Facades\Auth;
class AdvertisingProviderController extends Controller
{

    public function all_advirtising(){
        $user_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $all_advertising = Advertising::where('lan',$lan)->get();
        $ad_details = [];
        foreach($all_advertising as $advertising){
            if($lan == '1'){
                $car = Car::where('id',$advertising->car_id)->first();
            }else{
                $car = Car::where('id',$advertising->car_id)->first();
            }
            $final = array('advertising'=>$advertising ,'car'=>$car);
            array_push($ad_details,$final);
        }
        $notifications = Notification::where('lan',$lan)->where('user_id',$user_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.advertising.all-advertising',compact('ad_details','notifications','status_notification'));
    }
}
