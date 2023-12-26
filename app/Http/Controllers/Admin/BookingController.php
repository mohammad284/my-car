<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarImage;
use App\Models\User;
use App\Models\CarType;
use App\Models\CustomerReview;
use App\Models\Car;
use Validator;
use App\Models\Notification;
use App\Models\Booking;
class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function providerBooking(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $provider_booking = Booking::all();
        $booking_details = [];
        foreach($provider_booking as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $user = User::where('id',$booking->user_id)->first();
            $provider = User::where('id',$booking->provider_id)->first();
            $final = array('booking'=>$booking , 'car'=>$car , 'user'=>$user , 'provider'=>$provider);
            array_push($booking_details ,$final);
        }
        return view('dashboard.booking.report',compact('booking_details','status_notification','notifications'));
    }
}
