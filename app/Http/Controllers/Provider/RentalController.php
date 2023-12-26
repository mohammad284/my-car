<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Car;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\CarModel;
use App\Models\Booking;
use App\Models\CarType;
use App\Models\MunualRental;
class RentalController extends Controller
{
    public function munual_rental(){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $users = User::all();
        $cars = Car::where('lan',$lan)->where('provider_name',$provider_id)->where('booking_status','0')->get();
        $countries = Country::all();
        $cities    = City::all();
        $types     = CarType::where('lan',$lan)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.rental.munual-rental',compact('notifications','status_notification','cars','users','countries','cities','types'));
    }
    public function rental(Request $request){
        
        $car = Car::where('id',$request->car_id)->first();
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car->id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
        }else{
            $car_en = Car::where('id',$car->id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
        }
        $car_en->booking_status = '1';
        $car_ar->booking_status = '1';
        $car_en->save();
        $car_ar->save();
        $data =[
            'user_id'     => $request->user_id,
            'user_name'   => $request->name,
            'car_id'      => $request->car_id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'status'      => 'prossing',
            'price'       => $request->price,
            'country_id'  => $request->country_id,
            'city_id'     => $request->city_id
        ];
        $booking = MunualRental::create($data);
        return redirect()->back();
    }
    public function providerBooking(){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $cars = Booking::with('user','car')->where('provider_id',$provider_id)->orderBy('created_at','DESC')->get();
        return view('dashboard.booking.provider-booking',compact('cars','notifications','status_notification'));
    }
    public function deleteBooking($booking_id){
        $app_lan = app()->getLocale();
        $booking = Booking::find($booking_id)->delete();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
    public function changeStatus($booking_id){
        $booking = Booking::find($booking_id);
       
        if($booking->status == 'waiting'){
            $car = Car::find($booking->car_id);
            if($car->ar_id == null){
                $car_ar = Car::where('id',$car->id)->first();
                $car_en = Car::where('ar_id',$car_ar->id)->first();
            }else{
                $car_en = Car::where('id',$car->id)->first();
                $car_ar = Car::where('id',$car_en->ar_id)->first();
            }
            $car_en->booking_status = '1';
            $car_ar->booking_status = '1';
            $car_en->save();
            $car_ar->save();
            $booking->status = 'prossing';
            $booking->save();
            $data = [
                'notification' => 'تم قبول طلبك',
                'sender'       => '0',
                'user_id'      => $booking->user_id,
                'lan'          => '1',
                'status'       => '0'
            ];
            
            Notification::create($data);
            $data = [
                'notification' => 'request has been accepted',
                'sender'       => '0',
                'user_id'      => $booking->user_id,
                'lan'          => '2',
                'status'       => '0'
            ];
            Notification::create($data);
            return redirect()->back();
        }
        if($booking->status == 'prossing'){
            $car = Car::find($booking->car_id);
            if($car->ar_id == null){
                $car_ar = Car::where('id',$car->id)->first();
                $car_en = Car::where('ar_id',$car_ar->id)->first();
            }else{
                $car_en = Car::where('id',$car->id)->first();
                $car_ar = Car::where('id',$car_en->ar_id)->first();
            }
            $car_en->booking_status = '0';
            $car_ar->booking_status = '0';
            $car_en->save();
            $car_ar->save();
            $booking->status = 'finished';
            $booking->save();
            $data = [
                'notification' => 'شكرا لك على استخدام شركتنا',
                'sender'       => '0',
                'user_id'      => $booking->user_id,
                'lan'          => '1',
                'status'       => '0'
            ];
            
            Notification::create($data);
            $data = [
                'notification' => 'thank you for using our company',
                'sender'       => '0',
                'user_id'      => $booking->user_id,
                'lan'          => '2',
                'status'       => '0'
            ];
            Notification::create($data);
            return redirect()->back();
        }
        
    }
    public function changecity(Request $request){
        // return response()->json($request);
        $cities = City::where('country_id',$request->val)->get();
        return response()->json([
            'cities'=>$cities
        ]);
    }
    public function changebrand(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){
            $car = CarType::where('id',$request->val)->first();
            // return response()->json($request->val);
            $val = $car->ar_id;
        }else{
            $val = $request->val;
        }
        $brand = CarModel::where('type',$val)->get();
        return response()->json([
            'brand'=>$brand
        ]);
    }
    public function allRental (){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $rentals = MunualRental::with('car','city','country')->where('provider_id',$provider_id)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.rental.allRental',compact('notifications','status_notification','rentals'));
    }
    public function changeRentalStatus($rent_id){
        $booking = MunualRental::find($rent_id);
            $car = Car::find($booking->car_id);
            if($car->ar_id == null){
                $car_ar = Car::where('id',$car->id)->first();
                $car_en = Car::where('ar_id',$car_ar->id)->first();
            }else{
                $car_en = Car::where('id',$car->id)->first();
                $car_ar = Car::where('id',$car_en->ar_id)->first();
            }
            $car_en->booking_status = '0';
            $car_ar->booking_status = '0';
            $car_en->save();
            $car_ar->save();
            $booking->status = 'finished';
            $booking->save();
           
            return redirect()->back();
    }
    public function rentalFilter(Request $request){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $start_date = $request->start ;
        $end_date   = $request->end;
        $rentals = MunualRental::with('car','city','country')->whereBetween('created_at', [$start_date ,$end_date])->where('provider_id',$provider_id)->get();
        return view('dashboard.rental.allRental',compact('notifications','status_notification','rentals'));
    }
}
