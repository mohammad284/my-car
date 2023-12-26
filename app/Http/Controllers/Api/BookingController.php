<?php

namespace App\Http\Controllers\Api; 
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Booking;
    use App\Models\Car;
    use App\Models\CarImage;
    use App\Models\CarType;
    use App\Models\User;
    use App\Models\Notification;
class BookingController extends Controller
{
    public function historyBooking($user_id){
        $bookings = Booking::where('user_id',$user_id)->where('status','finished')->orderBy('id','DESC')->get();
        $booking_details = [];
        foreach ($bookings as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $images = CarImage::where('car_id',$car->id)->get();
            $type = CarType::where('id',$car->type)->first();
            $final = array('car'=>$car , 'images'=>$images , 'type'=>$type,'booking'=>$booking);
            array_push($booking_details , $final);
        }
        return response()->json([
            'status' => '1',
            'details' => $booking_details
        ], 200);
    }
    public function currentBooking($user_id){
        $bookings = Booking::where('user_id',$user_id)->where('status','prossing')->orWhere('status','waiting')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        $booking_details = [];
        foreach ($bookings as $booking){
            $car = Car::where('id',$booking->car_id)->first();
            $images = CarImage::where('car_id',$car->id)->get();
            $type = CarType::where('id',$car->type)->first();
            $final = array('car'=>$car , 'images'=>$images , 'type'=>$type,'booking'=>$booking);
            array_push($booking_details , $final);
        }
        return response()->json([
            'status' => '1',
            'details' => $booking_details
        ], 200);
    }
    public function sendBooking(Request $request ,$user_id,$car_id){
        $car = Car::where('id',$car_id)->first();
        $data =[
            'user_id'     => $user_id,
            'provider_id' => $car->provider_name,
            'car_id'      => $car_id,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'location'    => $request->location,
            'status'      => 'waiting',
            'price'       => $request->price,
            'longitude'   => $request->longitude,
            'latitude'    => $request->latitude
        ];
        $booking = Booking::create($data);
        $user = User::find($user_id);
        $data = [
            'notification' => "طلب استأجار جديد من قبل ($user->name) ",
            'sender'       => $car->provider_name,
            'user_id'      => '0',
            'lan'          => '1',
            'status'       => '0',
            'type'         => '6'
        ];
        $notification_ar = Notification::create($data);
        $data = [
            'notification' => "New rental request by ($user->name)",
            'sender'       => $car->provider_name,
            'user_id'      => '0',
            'lan'          => '2',
            'status'       => '0',
            'type'         => '6',
            'ar_id'        => $notification_ar->id
        ];
        Notification::create($data);

        return response()->json([
            'status' => '1',
            'details' => 'succesfully booking'
        ], 200);
    }
    public function requestbooking($provider_id){
        $bookings = Booking::where('provider_id',$provider_id)->where('status','waiting')->orderBy('id','DESC')->get();
        $booking_details = [];
        foreach ($bookings as $booking){
            $car    = Car::where('id',$booking->car_id)->first();
            $image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            // $type   = CarType::where('id',$car->type)->first();
            $user   = User::where('id',$booking->user_id)->first();
            $final  = array('booking'=>$booking,'car_name'=>$car->name,'number_of_car'=>$car->number_of_car,'user_name'=>$user->name ,'mobile'=>$user->mobile,'image'=>$image );
            array_push($booking_details , $final);
        }
        return response()->json([
            'status' => '1',
            'details' => $booking_details
        ], 200);
    }
    public function rejectBooking($id){
        $booking_request = Booking::where('id',$id)->first();
        $booking_request->status = 'rejected';
        $booking_request->save();
        return response()->json([
            'status' => '1',
            'details' => 'successfully rejected'
        ], 200);
    }
    public function changeStatus(Request $request,$id){
        $booking = Booking::find($id);
        if($request->status == 'accept'){
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
        }
        elseif($request->status == 'finish'){
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
        }
        return response()->json([
            'status' => '1',
            'details' => 'successfully prossing'
        ], 200);
    }
    public function prossingBooking($provider_id){
        $bookings = Booking::where('provider_id',$provider_id)->where('status','prossing')->orderBy('id','DESC')->get();
        $booking_details = [];
        foreach ($bookings as $booking){
            $car    = Car::where('id',$booking->car_id)->first();
            $image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            // $type   = CarType::where('id',$car->type)->first();
            $user   = User::where('id',$booking->user_id)->first();
            $final  = array('booking'=>$booking,'car_name'=>$car->name,'number_of_car'=>$car->number_of_car,'user_name'=>$user->name ,'mobile'=>$user->mobile,'image'=>$image );
            array_push($booking_details , $final);
        }
        return response()->json([
            'status' => '1',
            'details' => $booking_details
        ], 200);
    }
    public function finishBooking($provider_id){
        $bookings = Booking::where('provider_id',$provider_id)->where('status','finished')->orderBy('id','DESC')->get();
        $booking_details = [];
        foreach ($bookings as $booking){
            $car    = Car::where('id',$booking->car_id)->first();
            $image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            // $type   = CarType::where('id',$car->type)->first();
            $user   = User::where('id',$booking->user_id)->first();
            $final  = array('booking'=>$booking,'car_name'=>$car->name,'number_of_car'=>$car->number_of_car,'user_name'=>$user->name ,'mobile'=>$user->mobile,'image'=>$image );
            array_push($booking_details , $final);
        }
        return response()->json([
            'status' => '1',
            'details' => $booking_details
        ], 200);
    }
}