<?php

namespace App\Http\Controllers\Admin;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\CarImage;
    use App\Models\User;
    use App\Models\CarType;
    use App\Models\CustomerReview;
    use App\Models\Car;
    use App\Models\City;
    use App\Models\Notification;
    use App\Models\Booking;
    use App\Models\Percentage;
    use App\Models\Country;
    use Image;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Validator;
class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    public function acceptUser(Request $request ,$user_id){
        $provider = User::where('id',$user_id)->first();
        $provider->status = '1';
        $provider->percentage = $request->percentage;
        $provider->save();
        $data = [
            'notification' => "تم قبول طلبك كمزود خدمة ",
            'user_id'      => $provider->id,
            'lan'          => '1',
            'status'       => '0',
        ];
        $notification_ar = Notification::create($data);
        $data = [
            'notification' => "Your request has been accepted as a service provider",
            'user_id'      => $provider->id,
            'lan'          => '2',
            'status'       => '0',
            'ar_id'        => $notification_ar->id
        ];
        Notification::create($data);
        return redirect()->back();
    }
    public function requestProvider(){
        $providers = User::with('countries','cities')->where('type','provider')->where('status','0')->get();
        $count = count($providers);
        
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.user.request-provider',compact('providers','notifications','status_notification'));
    }
    public function allprovider(){
        $providers = User::where('type','provider')->where('status','1')->get();
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $locations = Country::all();
        $cities    = City::all();
        return view('dashboard.user.all-provider',compact('providers','notifications','status_notification','locations','cities'));
    }
    public function allUser(){
        $users = User::where('type','user')->get();
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $user_details =[];
        foreach($users as $user){
            $rentad_cars = Booking::where('user_id',$user->id)->get();
            // dd($user);
            $number_of_cars = count($rentad_cars);
            $final = array('user'=>$user,'number_of_cars'=>$number_of_cars);
            array_push($user_details,$final);
        }
        return view('dashboard.user.all-user',compact('user_details','notifications','status_notification'));
    }
    public function blockProvider(Request $request, $provider_id){
        $provider = User::where('id',$provider_id)->first();
        $provider->status = '2';
        $provider->reason_block = $request->reason_block;
        $provider->save();
        return redirect()->back();
    }
    public function blockedAccount(){
        $users  = User::where('status','2')->get();
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.user.blocked-account',compact('users','notifications','status_notification'));
    }
    public function activeAccount($user_id){
        $user = User::where('id',$user_id)->first();
        if($user->type == 'user'){
            $user->status = '0';
            $user->save();
        }else{
            $user->status = '1';
            $user->save();
        }
        return redirect()->back();
    }
    public function providerDetails($provider_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $provider = User::with('countries','cities')->where('id',$provider_id)->first();
        $provider_cars = Car::where('provider_name',$provider_id)->where('lan',$lan)->get();
        $cars_details = [];
        foreach($provider_cars as $car){

            $car_type = CarType::where('id',$car->type)->first();
            // $car_type = CarType::where('ar_id',$car->type)->first();
            $final = array('car'=>$car , 'type'=>$car_type);
            array_push($cars_details , $final);
        }
        $total_car = count($provider_cars);
        return view('dashboard.user.provider-details',compact('cars_details','total_car','provider','notifications','status_notification'));
    }
    public function editProvider($provider_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $locations = Country::all();
        $cities    = City::all();
        $provider = User::where('id',$provider_id)->first();

        return view('dashboard.user.provider-edit',compact('provider','notifications','status_notification','locations','cities'));
    }
    public function updateProvider(Request $request ,$provider_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $provider = User::where('id',$provider_id)->first();
        if ($provider->email != $request->email) {
            $simular_email = User::where('email',$request->email)->get();
            if (count($simular_email) > 0) {
                return response()->json(['message' => 'email has taken']);
            }   
        }
        if($request->city == null){
            $city = $provider->city;
            $country = $provider->country;
        }else{
            $city = $request->city;
            $country = $request->country;
        }
        $data = [
            'name'             => $request->name,
            'mobile'           => $request->mobile,
            'company_name'     => $request->company_name,
            'cr_number'        => $request->cr_number,
            'percentage'       => $request->percentage,
            'email'            => $request->email,
            'provider_address' => $request->provider_address,
            'city'             => $city,
            'country'          => $country
        ];
        $provider->update($data);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated successfully');
        }else{
            return redirect()->back()->with('message','تم التعديل بنجاح');
        }
    }
    public function edituser($user_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $user = User::where('id',$user_id)->first();

        return view('dashboard.user.user-edit',compact('user','notifications','status_notification'));
    }
    public function updateUser(Request $request ,$user_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $user = User::where('id',$user_id)->first();
        if ($user->email != $request->email) {
            $simular_email = User::where('email',$request->email)->get();
            if (count($simular_email) > 0) {
                if($app_lan == 'en'){
                    return redirect()->back()->with('message','الأيميل مأخوذ مسبقا');
                }else{
                    return redirect()->back()->with('message','email has taken');
                }
            }   
        }
        $user = User::where('id',$user_id)->first();
        $data = [
            'name'         => $request->name,
            'email'        => $request->email,
            'mobile'       => $request->mobile,
        ];
        $user->update($data);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated successfully');
        }else{
            return redirect()->back()->with('message','تم التعديل بنجاح');
        }
    }
    public function addProvider(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
            'mobile'    => ['required', 'unique:users'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        if ($request['image'] == NUll){
            $data['image'] = 'images/avatar.jpg';
        }
        if($request->file('company_icon')){
            $image=$request->file('company_icon');
            $input['company_icon'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['company_icon']);
            $name = $path.time().$input['company_icon'];
            
           $data['company_icon'] =  $name;
        }
        $percentage = Percentage::find('1');
        $user =  User::create([
            'name'          => $request['name'],
            'email'         => $request['email'],
            'mobile'        => $request['mobile'],
            'password'      => Hash::make($request['password']),
            'status'        => '1',
            'type'          => 'provider',
            'company_name'  => $request->company_name,
            'cr_number'     => $request->cr_number,
            'available_car' => $request->available_car,
            'image'         => $data['image'],
            'provider_address'=>$request->provider_address,
            'company_icon'   => $data['company_icon'],
            'percentage'    => $percentage->percentage,
            'country'       => $request->country,
            'city'          => $request->city,
            'country'       => $request->country
        ]);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','added successfully');
        }else{
            return redirect()->back()->with('message','تم الإضافة بنجاح');
        }

    }
    public function deleteProvider($provider_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $provider = User::where('id',$provider_id)->first();
        $provider->delete();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
    public function deleteUser($user_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $user = User::where('id',$user_id)->first();
        $user->delete();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
    public function changeCity(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $cities = City::where('country_id',$request->val)->get();
        return response()->json([
            'cities'=>$cities
        ],200);
    }
}