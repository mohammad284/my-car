<?php

namespace App\Http\Controllers\Provider;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Notification;
    use App\Models\CarImage;
    use App\Models\Color;
    use App\Models\CustomerReview;
    use App\Models\Car;
    use App\Models\Advertising;
    use App\Models\CarType;
    use Validator;
    use Image;
    use App\Models\User;
    use App\Models\CarModel;
    use App\Models\Country;
    use App\Models\City;
    use Illuminate\Support\Facades\Auth;
class CarProviderController extends Controller
{
    public function addCar(){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $providers = User::where('type','provider')->where('status','1')->get();
        $types     = CarType::where('lan',$lan)->get();
        $colors    = Color::all();
        $models = CarModel::all();
        $countries = Country::all();
        $cities    = City::all();
        if($app_lan == 'ar'){
            return view('dashboard.car.add-car-ar',compact('notifications','status_notification','providers','types','models','colors','countries','cities'));
        }else{
            return view('dashboard.car.add-car-en',compact('notifications','status_notification','providers','types','models','colors','countries','cities'));
        }

    }
    public function store(Request $request){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [
            'type'                     => ['required'],
            'specification_ar'         => ['required'],
            'specification_en'         => ['required'],
            'important_information_ar' => ['required'],
            'important_information_en' => ['required'],
            'security_deposit'         => ['required'],
            'damage_excess_ar'         => ['required'],
            'damage_excess_en'         => ['required'],
            'fuel_policy_ar'           => ['required'],
            'fuel_policy_en'           => ['required'],
            'mileage'                  => ['required'],
            'color'                    => ['required'],
            'automatic'                => ['required'],
            'site'                     => ['required'],
            'door'                     => ['required'],
            'extra_information_en'     => ['required'],
            'extra_information_ar'     => ['required'],
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $model  = CarModel::find($request->name_ar);
        $car_ar =  Car::create([
            'name'                   =>  $model->model,
            'type'                   =>  $request['type'],
            'provider_name'          =>  $provider_id,
            'specification'          =>  $request['specification_ar'],
            'important_information'  =>  $request['important_information_ar'],
            'security_deposit'       =>  $request['security_deposit'],
            'damage_excess'          =>  $request['damage_excess_ar'],
            'fuel_policy'            =>  $request['fuel_policy_ar'],
            'mileage'                =>  $request['mileage'],
            'extra_information'      =>  $request['extra_information_ar'],
            'color_id'               =>  $request['color'],
            'automatic'              =>  $request['automatic'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'price_for_day'          =>  $request['price_for_day'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_ar'],
            'lan'                    => '1',
            'manufacturing'          => $request->manufacturing,
            'monthly_price'          => $request->monthly_price,
            'weekly_price'           => $request->weekly_price
        ]);
        $car_en =  Car::create([
            'name'                   =>  $model->model,
            'price_for_day'          =>  $request['price_for_day'],
            'type'                   =>  $request['type'],
            'provider_name'          =>  $provider_id,
            'specification'          =>  $request['specification_en'],
            'important_information'  =>  $request['important_information_en'],
            'security_deposit'       =>  $request['security_deposit'],
            'damage_excess'          =>  $request['damage_excess_en'],
            'fuel_policy'            =>  $request['fuel_policy_en'],
            'mileage'                =>  $request['mileage'],
            'extra_information'      =>  $request['extra_information_en'],
            'color_id'               =>  $request['color'],
            'automatic'              =>  $request['automatic'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_en'],
            'lan'                    => '2',
            'ar_id'                  => $car_ar->id,
            'manufacturing'          => $request->manufacturing,
            'monthly_price'          => $request->monthly_price,
            'weekly_price'           => $request->weekly_price
        ]);
        CarImage::insert( [
            'image'=>  $model->image,
            'car_id'=> $car_ar->id,
            'car_en_id'=> $car_en->id,
        ]);
        if($app_lan == 'en'){
            return redirect('/provider/allCars')->with('message','A new car has been successfully added');
        }else{
            return redirect('/provider/allCars')->with('message','تم إضافة سيارة جديدة بنجاح');
        }
    }
    public function allCars(){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $cars = Car::where('lan',$lan)->where('provider_name',$provider_id)->get();
        $all_cars = [];
        foreach($cars as $car){
            $type = CarType::where('id',$car->type)->first();
            $provider = User::where('id',$car->provider_name)->first();
            $image = CarImage::where('car_id',$car->id)->where('car_id',$car->id)->first();
            $reviews = CustomerReview::where('car_id',$car->id)->count();
            $color   = Color::where('id',$car->color_id)->first();
            $country = Country::where('id',$car->country_id)->first();
            $city    = City::where('id',$car->city_id)->first();
            $final = array('car'=>$car,'type'=>$type,'provider'=>$provider,'image'=>$image,'reviews'=>$reviews,'color'=>$color,'country'=>$country,'city'=>$city);
            array_push($all_cars,$final);
        }
        return view('dashboard.car.all-cars',compact('notifications','status_notification','all_cars'));
    }
    public function editCar($car_id){
        $provider_id = Auth::user()->id;
        $car = Car::find($car_id);
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car_id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
        }else{
            $car_en = Car::where('id',$car_id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
        }
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $types = CarType::where('lan',$lan)->get();
        $colors    = Color::all();
        $models = CarModel::all();
        $countries = Country::all();
        $cities    = City::all();
        return view('dashboard.car.edit-car',compact('notifications','status_notification','car_ar','car_en','types','cities','countries','colors','models'));

    }
    public function updateCar(Request $request,$car_id){
        // dd($request);
        $provider_id = Auth::user()->id;
        $car = Car::find($car_id);
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car_id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
        }else{
            $car_en = Car::where('id',$car_id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
        }
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $model  = CarModel::find($request->name_ar);
        $data_ar = [
            'name'                   =>  $model->model,
            'type'                   =>  $request['type'],
            'provider_name'          =>  $provider_id,
            'specification'          =>  $request['specification_ar'],
            'important_information'  =>  $request['important_information_ar'],
            'security_deposit'       =>  $request['security_deposit'],
            'damage_excess'          =>  $request['damage_excess_ar'],
            'fuel_policy'            =>  $request['fuel_policy_ar'],
            'mileage'                =>  $request['mileage'],
            'extra_information'      =>  $request['extra_information_ar'],
            'color'                  =>  $request['color'],
            'automatic'              =>  $request['automatic'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'price_for_day'          =>  $request['price_for_day'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_ar'],
            'lan'                    => '1',
            'manufacturing'          => $request->manufacturing,
            
        ];
        $data_en = [
            'name'                   =>  $model->model,
            'price'                  =>  $request['price'],
            'type'                   =>  $request['type'],
            'provider_name'          =>  $provider_id,
            'specification'          =>  $request['specification_en'],
            'important_information'  =>  $request['important_information_en'],
            'security_deposit'       =>  $request['security_deposit'],
            'damage_excess'          =>  $request['damage_excess_en'],
            'fuel_policy'            =>  $request['fuel_policy_en'],
            'mileage'                =>  $request['mileage'],
            'extra_information'      =>  $request['extra_information_en'],
            'color'                  =>  $request['color'],
            'automatic'              =>  $request['automatic'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'price_for_day'          =>  $request['price_for_day'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_en'],
            'lan'                    => '2',
            'ar_id'                  => $car_ar->id,
            'manufacturing'          => $request->manufacturing,
        ];
        $images = CarImage::where('car_id',$car_id->id)->delete();
        CarImage::insert( [
            'image'=>  $model->image,
            'car_id'=> $car_ar->id,
            'car_en_id'=> $car_en->id,
        ]);
        $car_ar->update($data_ar);
        $car_en->update($data_en);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated successfully');
        }else{
            return redirect()->back()->with('message','تم التعديل بنجاح');
        }
    }
    public function removeCar($car_id){
        $app_lan = app()->getLocale();
        $car = Car::find($car_id);
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car_id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
        }else{
            $car_en = Car::where('id',$car_id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
        }
        $car_en->delete();
        $car_ar->delete();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
    public function allReviews(){
        $provider_id = Auth::user()->id;
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $cars = Car::where('lan',$lan)->get();
        $cars_details = [];
        foreach($cars as $car){
            $car_image = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            $final = array('car'=>$car , 'image'=>$car_image);
            array_push($cars_details ,$final);
        }
        return view('dashboard.review.all-review',compact('cars_details','notifications','status_notification'));
    }
    public function carReview($car_id){
        $provider_id = Auth::user()->id;
        $reviews = CustomerReview::where('car_id',$car_id)->get();
        $reviews_details = [];
        foreach($reviews as $review){
            $user = User::where('id',$review->user_id)->first();
            $car = Car::where('id',$review->car_id)->first();
            $final = array('review'=>$review , 'user'=>$user, 'car'=>$car);
            array_push($reviews_details,$final);
        }
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->where('user_id',$provider_id)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.review.review-details',compact('reviews_details','notifications','status_notification'));
    }
}
