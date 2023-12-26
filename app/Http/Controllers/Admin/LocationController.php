<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use App\Models\Admin;
use App\Models\ContactUs;
use App\Models\WelcomeEmail;
use App\Models\Country;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon;
use Validator;
use App\Models\Notification;
class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function countries(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $countries = Country::all();
        return view('dashboard.location.location',compact('notifications','status_notification','countries'));
    }
    public function cities(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $cities = City::with('Country')->get();
        $countries = Country::all();
        // return $cities;
        return view('dashboard.location.city',compact('notifications','status_notification','cities','countries'));
    }
    public function addCountry(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $data = [
            'country'  =>$request->country,
        ];
        Country::create($data);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','added seccessfully');
        }else{
            return redirect()->back()->with('message','تم حفظ البيانات بنجاح ');
        }
    }
    public function addCity(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $data = [
            'city'       => $request->city,
            'country_id' => $request->country_id
        ];
        City::create($data);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','added seccessfully');
        }else{
            return redirect()->back()->with('message','تم حفظ البيانات بنجاح ');
        }
    }
    public function updateCountry(Request $request,$coun_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $country = Country::find($coun_id);
        $country->country = $request->country;
        $country->save();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated seccessfully');
        }else{
            return redirect()->back()->with('message','تم تعديل البيانات بنجاح ');
        }
    }
    public function updateCity(Request $request,$city_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $city = City::find($city_id);
        $city->city = $request->city;
        $city->country_id = $request->country_id;
        $city->save();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated seccessfully');
        }else{
            return redirect()->back()->with('message','تم تعديل البيانات بنجاح ');
        }
    }
    public function deleteLocation($loc_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $location  = Location::find($loc_id);
        $location->delete();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','deleted seccessfully');
        }else{
            return redirect()->back()->with('message','تم حذف البيانات بنجاح ');
        }
    }
}
