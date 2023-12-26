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
use Validator;
use App\Models\Notification;
class GalleryFrontController extends Controller
{
    public function gallery(){

        $login = Auth::user(); 
        $top_cars = Car::orderBy('rating')->where('lan','1')->take(5)->get();
        $top_car_details=[];
        foreach($top_cars as $top_car){
            $image = CarImage::where('car_id',$top_car->id)->first();
            $final = array('car'=>$top_car,'image'=>$image);
            array_push($top_car_details, $final);
        }
        if ($login == null ){
            $cars = Car::where('lan','2')->get();
            $types = CarType::where('lan','2')->get();
            $car_details = [];
            foreach($cars as $car){
                $image = CarImage::where('car_en_id',$car->id)->first();
                $type  = CarType::where('id',$car->type)->first();
                $final = array('car'=>$car , 'image'=>$image,'type'=>$type);
                array_push($car_details , $final);
            }
            return view('front-end.gallery',compact('car_details','types','top_car_details'));
        }else{
            $user = User::find(Auth::user()->id);
            $cars = Car::where('lan','2')->get();
            $types = CarType::where('lan','2')->get();
            $car_details = [];
            foreach($cars as $car){
                $image = CarImage::where('car_en_id',$car->id)->first();
                $type  = CarType::where('id',$car->type)->first();
                $final = array('car'=>$car , 'image'=>$image,'type'=>$type);
                array_push($car_details , $final);
            }
            return view('front-end.gallery',compact('car_details','types','user','top_car_details'));
        }
    }
    public function details(Request $request){
        $car = Car::find($request->car_id);
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car->id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
        }else{
            $car_en = Car::where('id',$car->id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
        }
        $images = CarImage::where('car_id',$car_ar->id)->orWhere('car_en_id',$car_en->id)->get();

        $reviews = CustomerReview::where('car_id',$car_ar->id)->get();

        $review_details = [];
        foreach($reviews as $review){
            $user = User::where('id',$review->user_id)->first();
            $final = array('user'=>$user , 'review'=>$review);
            array_push($review_details , $final);
        }
        $review_count = count($reviews);
        $bg_image  = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
        $cars_type = Car::where('type',$car->type)->where('lan','2')->get();
        $car_type_details = [];
        foreach($cars_type as $car_type){
            $car_type_image = CarImage::where('car_id',$car_type->id)->orWhere('car_en_id',$car_type->id)->first();
            $final = array('car_type'=>$car_type , 'image'=>$car_type_image);
            array_push($car_type_details , $final);
        }
        $login = Auth::user(); 
        if ($login == null ){
            return view('front-end.details',compact('car','images','reviews','review_count','review_details','bg_image','car_type_details'));
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.details',compact('car','user','images','reviews','review_count','review_details','bg_image','car_type_details'));
        }
    }
}