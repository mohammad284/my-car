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
class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function ediReview($review_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $review = CustomerReview::where('id',$review_id)->first();
        $car = Car::where('id',$review->car_id)->first();
        $user = User::where('id',$review->user_id)->first();
        return view('dashboard.review.edit-review',compact('notifications','status_notification','review','car','user'));
    }
    public function updateReview(Request $request , $review_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $review = CustomerReview::where('id',$review_id)->first();
        $review->comment = $request->comment;
        $review->save();
        return redirect()->back();
    }
}
