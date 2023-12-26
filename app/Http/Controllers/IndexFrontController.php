<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Advertising;
use Image;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\CustomerReview;
use App\Models\Car;
use App\Models\Privacy;
use Validator;
use App\Models\Notification;
class IndexFrontController extends Controller
{
    public function index(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        
        $car_types = CarType::where('lan',$lan)->get();
        $top_cars = Car::orderBy('rating')->where('lan','1')->take(5)->get();
        $top_car_details=[];
        foreach($top_cars as $top_car){
            $image = CarImage::where('car_id',$top_car->id)->first();
            $final = array('car'=>$top_car,'image'=>$image);
            array_push($top_car_details, $final);
        }
        $all_cars = Car::where('lan','1')->get();
        $all_cars_details=[];
        foreach($all_cars as $all_car){
            $image = CarImage::where('car_id',$all_car->id)->first();
            $final = array('car'=>$all_car,'image'=>$image);
            array_push($all_cars_details, $final);
        }
        $car_details = [];
        foreach($all_cars as $car){
            $image = CarImage::where('car_id',$car->id)->first();
            $type  = CarType::where('id',$car->type)->first();
            $final = array('car'=>$car , 'image'=>$image,'type'=>$type);
            array_push($car_details , $final);
        }
        $all_advertising = Advertising::where('lan','2')->take(7)->get();
        $advertising_details = [];
        foreach($all_advertising as $advertising){
            $car  = Car::where('id',$advertising->car_id)->orWhere('id',$advertising->car_id)->first();
            $image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            $final = array('car'=>$car , 'image'=>$image);
            array_push($advertising_details , $final);
        }
        $reviews = CustomerReview::take(5)->orderBy('id','DESC')->get();

        $all_review = [];
        foreach($reviews as $review){
            $user = User::find($review->user_id);
            $car = Car::where('id',$review->car_id)->first();
            $images = CarImage::where('car_id',$car->id)->take(3)->get();
            $final = array('car'=>$car , 'review'=>$review , 'user'=>$user,'images'=>$images);
            array_push($all_review ,$final);
        }
        $last_advertising = Advertising::orderby('created_at','DESC')->where('lan','2')->take(2)->get();
        $last_advetising_details =[];
        foreach($last_advertising as $ad){
            $car = Car::where('ar_id',$ad->car_id)->orWhere('id',$ad->car_id)->first();
            $final = array('car'=>$car,'advertising'=>$ad);
            array_push($last_advetising_details,$final);
        }
        // dd($last_advetising_details);
        $login = Auth::user(); 
        if ($login == null ){

            return view('front-end.index',compact('car_types','last_advetising_details','all_review','top_car_details','all_cars_details','car_details','advertising_details'));
        }else{
            $user = User::find(Auth::user()->id);

            return view('front-end.index',compact('user','last_advetising_details','all_review','car_types','top_car_details','all_cars_details','car_details','advertising_details'));
        }
    }
    public function index2(){
        $login = Auth::user(); 
        if ($login == null ){
            $cars = Car::where('lan','1')->get();
            $types = CarType::all();
            $car_details = [];
            foreach($cars as $car){
                $image = CarImage::where('car_id',$car->id)->first();
                $type  = CarType::where('id',$car->type)->first();
                $final = array('car'=>$car , 'image'=>$image,'type'=>$type);
                array_push($car_details , $final);
            }
            return view('front-end.index2',compact('car_details','types'));
        }else{
            $user = User::find(Auth::user()->id);
            $cars = Car::where('lan','1')->get();
            $types = CarType::all();
            $car_details = [];
            foreach($cars as $car){
                $image = CarImage::where('car_id',$car->id)->first();
                $type  = CarType::where('id',$car->type)->first();
                $final = array('car'=>$car , 'image'=>$image,'type'=>$type);
                array_push($car_details , $final);
            }
            return view('front-end.index2',compact('car_details','types','user'));
        }
    }

    public function contactUs(){
        $login = Auth::user(); 
        if ($login == null ){
            return view('front-end.contact');
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.contact',compact('user'));
        }
    }
    public function allAdvertising(){
        $login = Auth::user(); 
        $all_advertising = Advertising::where('lan','2')->get();
        $advertising_details = [];
        foreach($all_advertising as $advertising){
            $car  = Car::where('id',$advertising->car_id)->orWhere('id',$advertising->car_id)->first();
            $user = User::where('id',$car->provider_name)->first();
            $final = array('car'=>$car ,'user'=>$user,'advertising'=>$advertising);
            array_push($advertising_details , $final);
        }
        if ($login == null ){
            return view('front-end.all-advertising',compact('user','advertising_details'));
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.all-advertising',compact('user','advertising_details'));
        }
    }
    public function privacy(){
        $login = Auth::user(); 
        $privacy = Privacy::where('lan','2')->first();
        if ($login == null ){
            return view('front-end.privacy',compact('privacy'));
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.privacy',compact('user','privacy'));
        }
    }
    public function account(){
        $login = Auth::user(); 
        if ($login == null ){
            return view('front-end.account');
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.account',compact('user'));
        }
    }
    public function editAccount(){
        $login = Auth::user(); 
        if ($login == null ){
            return view('front-end.edit-account');
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.edit-account',compact('user'));
        }
    }
    public function updateAccount(Request $request){
        $user = User::find(Auth::user()->id);
        $data = [
            'name' =>$request->name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'password' => Hash::make($request['password']),
        ];
        $user->update($data);
        return redirect()->back();
    }
}
