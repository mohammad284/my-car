<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\Car;
use App\Models\Advertising;
use App\Models\Notification;
use App\Models\Color;
use App\Models\User;
use Validator;
class AdvertisingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function showAddForm(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $cars = Car::where('lan',$lan)->get();
        $colors = Color::all();
        $providers = User::where('type','provider')->where('status','1')->get();
        if($lan == 1){
            return view('dashboard.advertising.add-advertising-ar',compact('notifications','status_notification','cars','providers','colors'));
        }else{
            return view('dashboard.advertising.add-advertising-en',compact('notifications','status_notification','cars','providers','colors'));
        }
    }
    public function storeAdvertising(Request $request){
        $validator = Validator::make($request->all(), [
            'text_en'    => ['required'],
            'text_ar'    => ['required'],
            'bg_color'   => ['required'],
            'font_color' => ['required'],
            'image'      => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $lan = app()->getLocale();
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/advertising/';
            $destinationPath = 'images/advertising';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  $name;
        }
        $data_ar = [
            'text'       => $request->text_ar,
            'image'      => $data['image'],
            'bg_color'   => $request->bg_color,
            'font_color' => $request->font_color,
            'car_id'     => $request->car_id,
            'lan'        => '1'
        ];
        
        $advertising_ar = Advertising::create($data_ar);
        $data_en = [
            'text'       => $request->text_en,
            'image'      => $data['image'],
            'bg_color'   => $request->bg_color,
            'font_color' => $request->font_color,
            'car_id'     => $request->car_id,
            'lan'        => '2',
            'ar_id'      => $advertising_ar->id,
        ];
        $advertising_en = Advertising::create($data_en);
        if($lan == 'en'){
            return redirect('/admin/allAdvirtising')->with('message','a new AD has been successfully added');
        }else{
            return redirect('/admin/allAdvirtising')->with('message','تم إضافة إعلان جديد بنجاح');
        }
    }
    public function editAdvertising($ad_id){
        $advertising = Advertising::find($ad_id);
        if($advertising->ar_id == null){
            $advertising_ar = Advertising::where('id',$ad_id)->first();
            $advertising_en = Advertising::where('ar_id',$advertising_ar->id)->first();
        }else{
            $advertising_en = Advertising::where('id',$ad_id)->first();
            $advertising_ar = Advertising::where('id',$advertising_en->ar_id)->first();
        }
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $car_selected = Car::where('id',$advertising->car_id)->first();
        $cars = Car::where('lan',$lan)->get();
        $providers = User::where('type','provider')->where('status','1')->get();
        return view('dashboard.advertising.edit-advertising',compact('cars','providers','car_selected','advertising_en','advertising_ar','notifications','status_notification'));
    }
    public function updateAdvertising(Request $request,$ad_id){
        $lan = app()->getLocale();
        $advertising = Advertising::where('id',$ad_id)->first();
        if($advertising->ar_id == null){
            $advertising_ar = Advertising::where('id',$ad_id)->first();
            $advertising_en = Advertising::where('ar_id',$advertising_ar->id)->first();
            
        }else{
            $advertising_en = Advertising::where('id',$ad_id)->first();
            $advertising_ar = Advertising::where('id',$advertising_en->ar_id)->first();
        }

        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/advertising/';
            $destinationPath = 'images/advertising';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  $name;
          }
          $data_ar = [
            'text'       => $request->text_ar,
            'image'      => $data['image'],
            'bg_color'   => $request->bg_color,
            'font_color' => $request->font_color,
            'car_id'     => $request->car_id,
            'lan'        => '1'
        ];
        $data_en = [
            'text'       => $request->text_en,
            'image'      => $data['image'],
            'bg_color'   => $request->bg_color,
            'font_color' => $request->font_color,
            'car_id'     => $request->car_id,
            'lan'        => '2',
            'ar_id'      => $advertising_ar->id,
        ];
        $advertising_ar->update($data_ar);
        $advertising_en->update($data_en);
        if($lan == 'en'){
            return redirect('/admin/allAdvirtising')->with('message','updated successfully');
        }else{
            return redirect('/admin/allAdvirtising')->with('message','تم التعديل بنجاح');
        }
    }
    public function allAdvirtising(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $all_advertising = Advertising::where('lan',$lan)->get();
        $ad_details = [];
        foreach($all_advertising as $advertising){
            if($lan == '1'){
                $car = Car::where('id',$advertising->car_id)->first();
            }else{
                $car = Car::where('id',$advertising->car_id)->first();
            }
            $final = array('advertising'=>$advertising ,'car'=>$car);
            array_push($ad_details,$final);
        }
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.advertising.all-advertising',compact('ad_details','notifications','status_notification'));
    }
    public function destroyAdvertising($ad_id){
        $advertising = Advertising::where('id',$ad_id)->first();
        $advertising->delete();
        return redirect()->back();
    }
    public function changeProvider(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $provider_cars = car::where('provider_name',$request->val)->where('lan',$lan)->get();
        return response()->json([
            'provider_cars'=>$provider_cars
        ],200);
    }
    public function removeAdvertising($ad_id){
        $advertising = Advertising::find($ad_id);
        if($advertising->ar_id == null){
            $advertising_ar = Advertising::where('id',$ad_id)->first();
            $advertising_en = Advertising::where('ar_id',$advertising_ar->id)->first();
            
        }else{
            $advertising_en = Advertising::where('id',$ad_id)->first();
            $advertising_ar = Advertising::where('id',$advertising_en->ar_id)->first();
        }
        $advertising_en->delete();
        $advertising_ar->delete();
        return redirect()->back();
    }
}
