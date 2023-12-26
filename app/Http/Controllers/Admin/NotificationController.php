<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use App\Models\Admin;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon;
use Validator;
use App\Models\Notification;
use App\Models\AppNotification;
class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function notifications(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $register_notifications = Notification::where('lan',$lan)->where('type','1')->orderBy('created_at', 'desc')->get();
        $register_notifications_details =[];
        foreach($register_notifications as $notification){
            $sender = User::where('id',$notification->provider_id)->first();
            $resever = User::where('id',$notification->user_id)->first();
            $final = array('notification'=>$notification,'sender'=>$sender,'resever'=>$resever);
            array_push($register_notifications_details,$final);
        }
        $update_notifications = Notification::where('lan',$lan)->where('type','2')->orderBy('created_at', 'desc')->get();
        $update_notifications_details =[];
        foreach($update_notifications as $notification){
            $sender = User::where('id',$notification->provider_id)->first();
            $resever = User::where('id',$notification->user_id)->first();
            $final = array('notification'=>$notification,'sender'=>$sender,'resever'=>$resever);
            array_push($update_notifications_details,$final);
        }
        $add_car_notifications = Notification::where('lan',$lan)->where('type','3')->orderBy('created_at', 'desc')->get();
        $add_car_notifications_details =[];
        foreach($add_car_notifications as $notification){
            $sender = User::where('id',$notification->provider_id)->first();
            $resever = User::where('id',$notification->user_id)->first();
            $final = array('notification'=>$notification,'sender'=>$sender,'resever'=>$resever);
            array_push($add_car_notifications_details,$final);
        }
        $add_ad_notifications = Notification::where('lan',$lan)->where('type','4')->orderBy('created_at', 'desc')->get();
        $add_ad_notifications_details =[];
        foreach($add_ad_notifications as $notification){
            $sender = User::where('id',$notification->provider_id)->first();
            $resever = User::where('id',$notification->user_id)->first();
            $final = array('notification'=>$notification,'sender'=>$sender,'resever'=>$resever);
            array_push($add_ad_notifications_details,$final);
        }
        $admin_notifications = Notification::where('lan',$lan)->where('type','5')->orderBy('created_at', 'desc')->get();
        $admin_notifications_details =[];
        foreach($admin_notifications as $notification){
            $sender = User::where('id',$notification->provider_id)->first();
            $resever = User::where('id',$notification->user_id)->first();
            $final = array('notification'=>$notification,'sender'=>$sender,'resever'=>$resever);
            array_push($admin_notifications_details,$final);
        }
        $booking_notifications = Notification::where('lan',$lan)->where('type','5')->orderBy('created_at', 'desc')->get();
        $booking_notifications_details =[];
        foreach($booking_notifications as $notification){
            $sender = User::where('id',$notification->provider_id)->first();
            $resever = User::where('id',$notification->user_id)->first();
            $final = array('notification'=>$notification,'sender'=>$sender,'resever'=>$resever);
            array_push($admin_notifications_details,$final);
        } 
        $status_notification = 1;
        foreach($register_notifications as $notification){
            $notification->status = 1;
            $notification->save();
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.notification.notification',compact('notifications','status_notification','register_notifications_details','update_notifications_details','add_car_notifications_details','add_ad_notifications_details','admin_notifications_details','booking_notifications_details'));
    }
    public function deleteNotification($not_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notification = Notification::where('id',$not_id)->first();
        $notification->delete();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
    public function sendNotifications(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $providers = User::where('type','provider')->where('status','1')->get();
        return view('dashboard.notification.send-notification',compact('notifications','status_notification','providers'));
    }
    public function sendTextNotification(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [
            'provider'        => ['required'],
            'notification_ar' => ['required'],
            'notification_en' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $users = User::all();
        if($request->user_id == 0){
            foreach($users as $user){
                $data_ar = [
                    'notification' => $request->notification_ar,
                    'sender'       => '0',
                    'user_id'      => $user->id,
                    'lan'          => '1',
                    'status'       => '1',
                    'type'         => '5',
                ];
                $notification_ar = Notification::create($data_ar);
                $data_en = [
                    'notification' => $request->notification_en,
                    'sender'       => '0',
                    'user_id'      => $user->id,
                    'lan'          => '1',
                    'status'       => '1',
                    'type'         => '5',
                    'ar_id'        => $notification_ar->id
                ];
                $notification_en = Notification::create($data_en);
            }
        }else{
            $data_ar = [
                'notification' => $request->notification_ar,
                'sender'       => '0',
                'user_id'      => $request->provider,
                'lan'          => '1',
                'status'       => '1',
                'type'         => '5',
            ];
            $notification_ar = Notification::create($data_ar);
            $data_en = [
                'notification' => $request->notification_en,
                'sender'       => '0',
                'user_id'     => $request->provider,
                'lan'          => '1',
                'status'       => '1',
                'type'         => '5',
                'ar_id'        => $notification_ar->id
            ];
            $notification_en = Notification::create($data_en);
        }
        if($app_lan == 'en'){
            return redirect()->back()->with('message','added successfully');
        }else{
            return redirect()->back()->with('message','تم الإضافة بنجاح');
        }
    }
    public function appNotification(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $app_notifications = AppNotification::all();
        return view('dashboard.notification.app-notification',compact('app_notifications','notifications','status_notification'));
    }
    public function updateNotification(Request $request ,$not_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notification = AppNotification::find($not_id);
        $notification->notification_ar = $request->notification_ar;
        $notification->notification_en = $request->notification_en;
        $notification->save();
        if($app_lan == 'en'){
            return redirect('/admin/appNotification')->with('message','updated successfully');
        }else{
            return redirect('/admin/appNotification')->with('message','تم التعديل بنجاح');
        }
        
    }
}
