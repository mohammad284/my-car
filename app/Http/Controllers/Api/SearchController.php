<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\CarTranslation;
use App\Models\CarImage;
class SearchController extends Controller
{
    //search by name car & price & specification
    public function search(Request $request ,$lan){
        $cars = Car::where('name', 'Like', '%' . $request->name. '%')->orWhere('price', 'Like', '%' . $request->name. '%')->orWhere('specification', 'Like', '%' . $request->name. '%')->where('lan',$lan)->get();
        $result = [];
        foreach($cars as $car){
            $car_image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            $final = array('car'=>$car , 'image'=>$car_image);
            array_push($result,$final);
        }
        return response()->json([
            'status'  => '1',
            'details' => $result
        ], 200);
    }
    public function advancedSearch(Request $request,$lan){
        $cars_location = Car::where('car_location', 'Like', '%' . $request->car_location. '%')->where('lan',$lan)->paginate(5);

        //return response()->json($cars_location);
        //$checker = Purchase::select('id')->where('id',$request->itemid)->exists();
        $available_car = [];
        foreach($cars_location as $car_location){
            $booking_car = Booking::where('car_id',$car_location->id)->first();
            if($booking_car != null){
                if($booking_car->status == 'waiting' || $booking_car->status == 'finished'){
                        $car = Car::where('id',$booking_car->car_id)->first();
                        $car_image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->take(1)->get();
                        $final = array('car'=>$car , 'images'=>$car_image);
                        array_push($available_car,$final);
                }else{
                    if($booking_car->end_date < $request->start_date){
                        $car = Car::where('id',$booking_car->car_id)->first();
                        $car_image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->take(1)->get();
                        $final = array('car'=>$car , 'images'=>$car_image);
                        array_push($available_car,$final);
                    }
                }
            }else{
                $car = Car::where('id',$car_location->id)->first();
                $car_image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->take(1)->get();
                $final = array('car'=>$car , 'images'=>$car_image);
                array_push($available_car,$final);
            }

        }
        return response()->json([
            'status' => '200',
            'details' =>$available_car
        ]);
    }

}
