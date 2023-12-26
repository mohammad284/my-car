<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Image;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\CustomerReview;
use App\Models\Car;
use App\Models\Booking;
use Validator;
use App\Models\Notification;
class SearchFrontController extends Controller 
{
    public function search(Request $request){
        $login = Auth::user();
        $cars = Car::where('name', 'Like', '%' . $request->name. '%')->where('lan','2')->orWhere('price_for_day', 'Like', '%' . $request->name. '%')->where('lan','2')->orWhere('specification', 'Like', '%' . $request->name. '%')->where('lan','2')->paginate(6);
        $cars_details = [];
        foreach($cars as $car){
            $image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            $type  = CarType::where('id',$car->type)->first();
            $final = array('car'=>$car , 'type'=>$type,'image'=>$image);
            array_push($cars_details , $final);
        }

        $search_count = count($cars);
        $name = $request->name;
        if ($login == null ){
            return view('front-end.search',compact('cars_details','cars','search_count','name'));
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.search',compact('cars_details','cars','search_count','name','user'));
        }
        
    }
    public function searchFiltter(Request $request){
        $price     = $request->price;
        $price_Array = explode("- " , $price);
        $first_price = explode("$" , $price_Array[0]);
        $second_price = explode("$" , $price_Array[1]);
        // $cars = Car::where('price_for_day','<=',$second_price[1])->where('lan','2')->get();
        // dd($cars);
        $cars = Car::where('price_for_day','<=',$first_price[1])->where('automatic',$request->automatic)->where('door',$request->door)->where('site',$request->passengers)->where('name', 'Like', '%' . $request->name. '%')->where('lan','2')->orWhere('price_for_day', 'Like', '%' . $request->name. '%')->where('lan','2')->orWhere('specification', 'Like', '%' . $request->name. '%')->where('lan','2')->paginate(6);
        $cars_details = [];
        foreach($cars as $car){
            $image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            $type  = CarType::where('id',$car->type)->first();
            $final = array('car'=>$car , 'type'=>$type,'image'=>$image);
            array_push($cars_details , $final);
        }
        $search_count = count($cars);
        $name = $request->name;
        $login = Auth::user();
        if ($login == null ){
            return view('front-end.search',compact('cars_details','cars','search_count','name'));
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.search',compact('cars_details','cars','search_count','name','user'));
        }
    }
    public function advancedSearch(Request $request){
        $login = Auth::user();
        if($request->type == 0){
            $cars_location = Car::where('car_location', 'Like', '%' . $request->car_location. '%')->where('lan','1')->get();

        }else{
            $cars_location = Car::where('car_location', 'Like', '%' . $request->car_location. '%')->where('type',$request->type)->where('lan','1')->get();

        }
        //return response()->json($cars_location);
        //$checker = Purchase::select('id')->where('id',$request->itemid)->exists();
        $cars_details = [];
        foreach($cars_location as $car_location){
            $booking_car = Booking::where('car_id',$car_location->id)->first();
            if($booking_car != null){
                if($booking_car->status == 'waiting' || $booking_car->status == 'finished'){
                        $car = Car::where('id',$booking_car->car_id)->first();
                        $car_image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
                        $final = array('car'=>$car , 'image'=>$car_image);
                        array_push($cars_details,$final);
                }else{
                    if($booking_car->end_date < $request->start_date){
                        $car = Car::where('id',$booking_car->car_id)->first();
                        $car_image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
                        $final = array('car'=>$car , 'image'=>$car_image);
                        array_push($cars_details,$final);
                    }
                }
            }else{
                $car = Car::where('id',$car_location->id)->first();
                $car_image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
                $final = array('car'=>$car , 'image'=>$car_image);
                array_push($cars_details,$final);
            }

        }
        $search_count = count($cars_location);
        if ($login == null ){
            return view('front-end.advanced-search',compact('cars_details','search_count'));
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.advanced-search',compact('cars_details','search_count','user'));
        }
    }
}
