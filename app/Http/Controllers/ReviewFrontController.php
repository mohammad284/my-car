<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Car;
use App\Models\CustomerReview;
use Illuminate\Http\Request;
use App\Models\CarImage;
use App\Models\CarType;
class ReviewFrontController extends Controller
{
    public function review(){
        $login = Auth::user(); 
        $reviews = CustomerReview::take(5)->get();
        $all_review = [];
        foreach ($reviews as $review){
            $car = Car::where('id',$review->car_id)->first();
            $images = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->take(3)->get();
            $user = User::where('id',$review->user_id)->first();
            $final = array('user'=>$user,'car'=>$car,'review'=>$review,'images'=>$images);
            array_push($all_review,$final);
        }
        if ($login == null ){
            return view('front-end.review',compact('all_review'));
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.review',compact('user','all_review'));
        }
    }
}
