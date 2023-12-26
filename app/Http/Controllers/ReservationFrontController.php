<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CarImage;
use App\Models\Car;
use App\Models\Notification;
use App\Models\Booking;
use Carbon\Carbon;
class ReservationFrontController extends Controller
{
    public function reservation(Request $request){
        $car = Car::find($request->car_id);
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car->id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
        }else{
            $car_en = Car::where('id',$car->id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
        }
        $bg_image  = CarImage::where('car_id',$car_ar->id)->first();
        $images = CarImage::where('car_id',$car_ar->id)->orWhere('car_en_id',$car_en->id)->get();
        $login = Auth::user(); 
        if ($login == null ){
            return redirect('/showAddLogin');
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.reservation',compact('images','user','bg_image','car_ar'));
        }
    }
    public function sendBooking(Request $request , $car_id){
        $car = Car::where('id',$car_id)->first();
        $date1 = $request->start_date;
        // End date
        $date2 = $request->end_date;
        $dateDiff = Carbon::parse(request('start_date'))->diffInDays(Carbon::parse(request('end_date')));
        $price = $dateDiff * $car->price_for_day;
        $user = User::find(Auth::user()->id);
        $data =[
            'user_id'     => $user->id,
            'provider_id' => $car->provider_name,
            'car_id'      => $car_id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'location'    => $request->location,
            'status'      => 'waiting',
            'price'       => $price,
        ];
        $booking = Booking::create($data);
        $user = User::find($user->id);
        $data = [
            'notification' => "طلب استأجار جديد من قبل ($user->name) ",
            'user_id'      => $car->provider_name,
            'lan'          => '1',
            'status'       => '0',
        ];
        Notification::create($data);
        $data = [
            'notification' => "New rental request by ($user->name)",
            'user_id'      => $car->provider_name,
            'lan'          => '2',
            'status'       => '0',
        ];
        Notification::create($data);
        return redirect('/');
    }

}
