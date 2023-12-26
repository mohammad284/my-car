<?php

namespace App\Http\Controllers\Provider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\User;
use Carbon;
use App\Models\Booking;
use App\Models\Advertising;
use Image;
use Illuminate\Support\Facades\Hash;
class ProviderController extends Controller
{

    public function index(){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $all_not = Notification::where('lan',$lan)->where('user_id',$provider_id)->whereDate('created_at', \Carbon\Carbon::today())->count();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $provider_booking = Booking::with('user','car')->where('provider_id',$provider_id)->count();
        $cars = Car::where('lan',$lan)->where('provider_name',$provider_id)->count();
        $all_advertising = Advertising::where('lan',$lan)->count();
        return view('dashboard.index',compact('notifications','status_notification','provider_booking','cars','all_not','all_advertising'));
    }
    public function allPartner(){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $partners = User::where('type','partner')->where('manager_company',$provider_id )->get();
        return view('dashboard.partner.all-partner',compact('status_notification','notifications','partners'));
    }
    public function storePartner(Request $request){
        $provider_id = Auth::user()->id;
        if ($request['image'] == NUll){
            $data['image'] = 'images/avatar.jpg';
        }
        if($request->file('cr_image')){
            $image=$request->file('cr_image');
            $input['cr_image'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['cr_image']);
            $name = $path.time().$input['cr_image'];
            
           $data['cr_image'] =  $name;
        }
        if($request->file('id_identify_image')){
            $image=$request->file('id_identify_image');
            $input['id_identify_image'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['id_identify_image']);
            $name = $path.time().$input['id_identify_image'];
            
           $data['id_identify_image'] =  $name;
        }
        $user =  User::create([
            'name'               => $request['name'],
            'email'              => $request['email'],
            'mobile'             => $request['mobile'],
            'password'           => Hash::make($request['password']),
            'status'             => '0',
            'type'               => 'partner',
            'id_identify_image'  => $data['id_identify_image'],
            'cr_image'           => $data['cr_image'],
            'provider_address'   => $request->provider_address,
            'image'              => $data['image'],
            'manager_company'    => $provider_id,
        ]);
        return redirect()->back()->with('message','تم الحفظ بنجاح');
    }
    public function addPartner(){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.partner.add-partner',compact('status_notification','notifications'));
    }
}
