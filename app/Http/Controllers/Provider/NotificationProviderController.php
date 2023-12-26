<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;
use Carbon;
use App\Models\Notification;
class NotificationProviderController extends Controller
{
    public function notifications(){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $provider_not  = Notification::where('lan',$lan)->where('user_id',$provider_id)->get();
        return view('dashboard.notification.notification',compact('notifications','status_notification','provider_not'));
    }
}
