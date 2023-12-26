<?php

namespace App\Http\Controllers\Admin;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Image;
    use App\Models\CarImage;
    use App\Models\User;
    use App\Models\CarType;
    use App\Models\CustomerReview;
    use App\Models\Car;
    use App\Models\Color;
    use App\Models\CarModel;
    use Validator;
    use App\Models\Country;
    use App\Models\City;
    use App\Models\Notification;
class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function addCarType(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        
        return view('dashboard.car.add-car-type',compact('notifications','status_notification'));
    }
    public function storeCarType(Request $request){
        $validator = Validator::make($request->all(), [
            'image'      => ['required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],

        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $lan = app()->getLocale();
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/car/';
            $destinationPath = 'images/car';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  $name;
        }
        $data_ar = [
            'type' => $request->type_ar,
            'image' => $data['image'],
            'lan'   => '1'
        ];
        $type_ar = CarType::create($data_ar);
        $data_en = [
            'type' => $request->type_en,
            'image' => $data['image'],
            'ar_id' => $type_ar->id,
            'lan'   => '2'
        ];
        CarType::create($data_en);
        if($lan == 'en'){
            return redirect('/admin/allCarsType')->with('message','A new category has been successfully added');
        }else{
            return redirect('/admin/allCarsType')->with('message','تم إضافة تصنيف جديد بنجاح');
        }
        
    }
    public function editCarType ($type_id){
        $type = CarType::find($type_id);
        if($type->ar_id == null){
            $type_ar = CarType::where('id',$type_id)->first();
            $type_en = CarType::where('ar_id',$type_ar->ar_id)->first();
            
        }else{
            $type_en = CarType::where('id',$type_id)->first();
            $type_ar = CarType::where('id',$type_en->ar_id)->first();
        }

        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.car.edit-car-type',compact('type_en','type_ar','notifications','status_notification'));
    }
    public function updateCarType(Request $request , $type_id){
        $validator = Validator::make($request->all(), [
            'type_ar'   => ['required'],
            'type_en'   => ['required'],
            'image'     => ['required'],

        ]);
        $lan = app()->getLocale();
        $type = CarType::find($type_id);
        if($type->ar_id == null){
            $type_ar = CarType::where('id',$type_id)->first();
            $type_en = CarType::where('ar_id',$type_ar->id)->first();
            
        }else{
            $type_en = CarType::where('id',$type_id)->first();
            $type_ar = CarType::where('id',$type_en->ar_id)->first();
        }
        if($request->file('image')){
            
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/car/';
            $destinationPath = 'images/car';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  $name;
        }

        $data_ar = [
            'type' => $request->type_ar,
            'image' => $data['image'],
            'lan'   => '1'
        ];
        $data_en = [
            'type' => $request->type_en,
            'image' => $data['image'],
            'ar_id' => $type_ar->id,
            'lan'   => '2'
        ];
        $type_ar->update($data_ar);
        $type_en->update($data_en);
        if($lan == 'en'){
            return redirect('/admin/allCarsType')->with('message','updated successfully');
        }else{
            return redirect('/admin/allCarsType')->with('message','تم التعديل بنجاح');
        }
    }
    public function removeCarType($type_id){
        $lan = app()->getLocale();
        $type = CarType::find($type_id);
        $type->delete();
        if($lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
    public function allCarsType(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};

        $types = CarType::where('lan',$lan)->get();
        $type_details = [];
        foreach($types as $type){
            $car_number = Car::where('type',$type->id)->count();
            $final = array('type'=>$type,'car_number'=>$car_number);
            array_push($type_details,$final);
        }
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.car.all-car-type',compact('type_details','notifications','status_notification'));
    }
    public function allReviews(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
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
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        return view('dashboard.review.review-details',compact('reviews_details','notifications','status_notification'));
    }
    public function addCar(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
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
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [

            'type'                     => ['required'],
            'provider_name'            => ['required'],
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
            'manufacturing'            => ['required'],
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $model  = CarModel::find($request->name_ar);
        $car_ar =  Car::create([
            'name'                   =>  $model->model,
            'type'                   =>  $request['type'],
            'provider_name'          =>  $request['provider_name'],
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
            'manufacturing'          =>  $request['manufacturing'],
            'price_for_day'          =>  $request['price_for_day'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_ar'],
            'lan'                    => '1',
            'country_id'             => $request->country_id,
            'city_id'                => $request->city_id,
            'monthly_price'          => $request->monthly_price,
            'weekly_price'           => $request->weekly_price
        ]);
        $car_en =  Car::create([
            'name'                   =>  $model->model,
            'price_for_day'          =>  $request['price_for_day'],
            'type'                   =>  $request['type'],
            'provider_name'          =>  $request['provider_name'],
            'specification'          =>  $request['specification_en'],
            'car_location'           =>  $request['car_location'],
            'important_information'  =>  $request['important_information_en'],
            'security_deposit'       =>  $request['security_deposit'],
            'damage_excess'          =>  $request['damage_excess_en'],
            'fuel_policy'            =>  $request['fuel_policy_en'],
            'mileage'                =>  $request['mileage'],
            'manufacturing'          =>  $request['manufacturing'],
            'extra_information'      =>  $request['extra_information_en'],
            'color'                  =>  $request['color'],
            'automatic'              =>  $request['automatic'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_en'],
            'lan'                    => '2',
            'ar_id'                  => $car_ar->id,
            'country_id'             => $request->country_id,
            'city_id'                => $request->city_id,
            'monthly_price'          => $request->monthly_price,
            'weekly_price'           => $request->weekly_price
        ]);

                CarImage::insert( [
                    'image'=>  $model->image,
                    'car_id'=> $car_ar->id,
                    'car_en_id'=> $car_en->id,
                ]);

        if($app_lan == 'en'){
            return redirect('/admin/allCarsType')->with('message','A new car has been successfully added');
        }else{
            return redirect('/admin/allCarsType')->with('message','تم إضافة سيارة جديدة بنجاح');
        }
    }
    public function edit($car_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $car = Car::find($car_id);
        return view('dashboard.car.edit-car',compact('notifications','status_notification','car'));
    }
    public function categoryCars($cat_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $type = CarType::where('id',$cat_id)->first();

        $cars = Car::where('type',$cat_id)->where('lan',$lan)->orWhere('type',$type->ar_id)->where('lan',$lan)->get();
        $cars_details = [];
        foreach($cars as $car){
            $provider = User::where('id',$car->provider_name)->first();
            $car_type = CarType::where('id',$car->type)->first();
            $image    = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            $final = array('car'=>$car , 'type'=>$car_type,'image'=>$image,'provider'=>$provider);
            array_push($cars_details , $final);
        }
        return view('dashboard.car.category-cars',compact('notifications','status_notification','cars_details'));
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
    public function editCar($car_id){
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
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $providers = User::where('type','provider')->where('status','1')->get();
        $colors    = Color::all();
        $types = CarType::all();
        $models = CarModel::all();
        $countries = Country::all();
        $cities    = City::all();
        return view('dashboard.car.edit-car',compact('notifications','status_notification','car_ar','car_en','cities','countries','providers','types','colors','models'));

    }
    public function updateCar(Request $request,$car_id){
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
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $data_ar = [
            'name'                   =>  $request['name_ar'],
            'type'                   =>  $request['type'],
            'provider_name'          =>  $request['provider_name'],
            'specification'          =>  $request['specification_ar'],
            'car_location'           =>  $request['car_location'],
            'important_information'  =>  $request['important_information_ar'],
            'security_deposit'       =>  $request['security_deposit'],
            'damage_excess'          =>  $request['damage_excess_ar'],
            'fuel_policy'            =>  $request['fuel_policy_ar'],
            'mileage'                =>  $request['mileage'],
            'extra_information'      =>  $request['extra_information_ar'],
            'color'                  =>  $request['color'],
            'manufacturing'          =>  $request['manufacturing'],
            'automatic'              =>  $request['automatic'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'price_for_day'          =>  $request['price_for_day'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_ar'],
            'lan'                    => '1',
        ];
        $data_en = [
            'name'                   =>  $request['name_ar'],
            'price_for_day'          =>  $request['price_for_day'],
            'type'                   =>  $request['type'],
            'provider_name'          =>  $request['provider_name'],
            'specification'          =>  $request['specification_en'],
            'car_location'           =>  $request['car_location'],
            'important_information'  =>  $request['important_information_en'],
            'security_deposit'       =>  $request['security_deposit'],
            'damage_excess'          =>  $request['damage_excess_en'],
            'fuel_policy'            =>  $request['fuel_policy_en'],
            'manufacturing'          =>  $request['manufacturing'],
            'mileage'                =>  $request['mileage'],
            'extra_information'      =>  $request['extra_information_en'],
            'color'                  =>  $request['color'],
            'automatic'              =>  $request['automatic'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_en'],
            'lan'                    => '2',
            'ar_id'                  => $car_ar->id,
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
    public function allCars(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $cars = Car::where('lan',$lan)->get();
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
    public function carmodel(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $models = CarModel::with('car_type')->get();
        $car_types = CarType::where('lan',$lan)->get();
        // return $models;
        return view('dashboard.car.car-model',compact('notifications','status_notification','models','car_types'));
    }
    public function addModel(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        if($app_lan == 'en'){
            $type_car = CarType::where('id',$request->type_id)->first();
            $type_id = $type_car->ar_id;
        }else{
            $type_id = $request->type_id;
        }
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/car/';
            $destinationPath = 'images/car';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  $name;
        }
        $data = [
            'model' => $request->model,
            'type'  => $type_id,
            'image' => $data['image']
        ];
        CarModel::create($data);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','added successfully');
        }else{
            return redirect()->back()->with('message','تم الحفظ بنجاح');
        }
    }
    public function updateModel(Request $request ,$mod_id){
        $validator = Validator::make($request->all(), [
            'type_id'      => ['required'],
            'model'     => ['required'],
        ]);

        if($validator->fails()){
            // return response()->json($validator->errors()->toJson(), 400);
            return redirect()->back()->with('message','إملأ كامل الحقول');
        }
        $model = CarModel::find($mod_id);
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        if($app_lan == 'en'){
            $type_car = CarType::where('id',$request->type_id)->first();
            $type_id = $type_car->ar_id;
        }else{
            $type_id = $request->type_id;
        }
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/car/';
            $destinationPath = 'images/car';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  $name;
        }else{
            $data['image'] = $model->image;  
        }
       
        $model->model = $request->model;
        $model->type  = $type_id;
        $model->image = $data['image'];
        $model->save();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','update successfully');
        }else{
            return redirect()->back()->with('message','تم التعديل بنجاح');
        }
    }
    public function deleteModel($mod_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $model = CarModel::find($mod_id);
        $model->delete();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
    public function activeCar($car_id){
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
        if($car->available == 1){
            $car->available = 0;
        }else{
            $car->available = 1;
        }
        $car->save();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','update successfully');
        }else{
            return redirect()->back()->with('message','تم التعديل بنجاح');
        }
    }
    public function changeBrand(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'en'){
            $car = CarType::where('id',$request->val)->first();
            // return response()->json($request->val);
            $val = $car->ar_id;
        }else{
            $val = $request->val;
        }
        $brand = CarModel::where('type',$val)->get();
        return response()->json([
            'brand'=>$brand
        ]);
    }
}
