<?php

namespace App\Http\Controllers\Api;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Advertising;
    use App\Models\Car;
    use App\Models\CarImage;
    use App\Models\CarType;
    use App\Models\CustomerReview;
    use App\Models\Notification;
    use App\Models\User;
    use App\Models\Country;
    use App\Models\City;
    use App\Models\CarModel;
    use App\Models\Color;
    use Image;
    use Validator;
class CarController extends Controller
{
    //store car
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name_ar'                  => ['required'],
            'name_en'                  => ['required'],
            'type'                     => ['required'],
            'provider_name'            => ['required'],
            'specification_ar'         => ['required'],
            'specification_en'         => ['required'],
            'car_location'             => ['required'],
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
            'image'                    => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $car_ar =  Car::create([
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
        ]);
        $car_en =  Car::create([
            'name'                   =>  $request['name_en'],
            'price'                  =>  $request['price'],
            'type'                   =>  $request['type'],
            'provider_name'          =>  $request['provider_name'],
            'specification'          =>  $request['specification_en'],
            'car_location'           =>  $request['car_location'],
            'important_information'  =>  $request['important_information_en'],
            'security_deposit'       =>  $request['security_deposit'],
            'damage_excess'          =>  $request['damage_excess_en'],
            'fuel_policy'            =>  $request['fuel_policy_en'],
            'mileage'                =>  $request['mileage'],
            'extra_information'      =>  $request['extra_information_en'],
            'color'                  =>  $request['color'],
            'automatic'              =>  $request['automatic'],
            'manufacturing'          =>  $request['manufacturing'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'price_for_day'          =>  $request['price_for_day'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_en'],
            'lan'                    => '2',
            'ar_id'                  => $car_ar->id,
        ]);
        if($request->file('image')){
            $path = 'images/car/';
            $files=$request->file('image');

            foreach($files as $file) {
 
                $input['image'] = $file->getClientOriginalName();
                $destinationPath = 'images/car/';
                
                $img = Image::make($file->getRealPath());
                $img->resize(800, 750, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.$input['image']);
                $name = $path.$input['image'];
                CarImage::insert( [
                    'image'=>  $name,
                    'car_id'=> $car_ar->id,
                    'car_en_id'=> $car_en->id,
                ]);

            }
        }
        $provider = User::where('id',$request->provider_name)->first();
        $data = [
            'notification' => "تم إضافة سيارة جديدة من قبل مزود الخدمة ($provider->name)",
            'sender'      => $provider->id,
            'user_id'      => '0',
            'type'         => '1',
            'lan'          => '1',
            'status'       => '0',
        ];
        $notification_ar = Notification::create($data);
        $data = [
            'notification' => "New vehicle added by service provider ($provider->name)",
            'sender'      => $provider->id,
            'user_id'      => '0',
            'lan'          => '2',
            'type'         => '1',
            'status'       => '0',
            'ar_id'        => $notification_ar->id
        ];
        Notification::create($data);
        return response()->json([
            'status' => '1',
            'details'=> 'successfully added'
        ], 200);
    }
    //update car
    public function update(Request $request ,$car_id ){
        $car = Car::where('id',$car_id)->first();
        
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car_id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
        }else{
            $car_en = Car::where('id',$car_id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
        }
        $validator = Validator::make($request->all(), [
            'name_ar'                  => ['required'],
            'name_en'                  => ['required'],
            'type'                     => ['required'],
            'provider_name'            => ['required'],
            'specification_ar'         => ['required'],
            'specification_en'         => ['required'],
            'car_location'             => ['required'],
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

        $data_ar =[
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
            'automatic'              =>  $request['automatic'],
            'manufacturing'          =>  $request['manufacturing'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'price_for_day'          =>  $request['price_for_day'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_ar'],
            'lan'                    => '1',
        ];
        $data_en =[
            'name'                   =>  $request['name_en'],
            'price'                  =>  $request['price'],
            'type'                   =>  $request['type'],
            'provider_name'          =>  $request['provider_name'],
            'specification'          =>  $request['specification_en'],
            'car_location'           =>  $request['car_location'],
            'important_information'  =>  $request['important_information_en'],
            'security_deposit'       =>  $request['security_deposit'],
            'damage_excess'          =>  $request['damage_excess_en'],
            'fuel_policy'            =>  $request['fuel_policy_en'],
            'mileage'                =>  $request['mileage'],
            'extra_information'      =>  $request['extra_information_en'],
            'color'                  =>  $request['color'],
            'automatic'              =>  $request['automatic'],
            'manufacturing'          =>  $request['manufacturing'],
            'site'                   =>  $request['site'],
            'door'                   =>  $request['door'],
            'price_for_day'          =>  $request['price_for_day'],
            'num_of_day'             =>  $request['num_of_day'],
            'number_of_car'          =>  $request['number_of_car_en'],
            'lan'                    => '2',
            'ar_id'                  => $car_ar->id,
        ];
        $car_ar->update($data_ar);
        $car_en->update($data_en);
        $provider = User::where('id',$request->provider_name)->first();
        $data = [
            'notification' => "قام ($provider->name) بتعديل السيارة الخاصة به",
            'sender'      => $provider->id,
            'user_id'      => '0',
            'lan'          => '1',
            'status'       => '0',
            'type'         => '4'
        ];
        $notification_ar = Notification::create($data);
        $data = [
            'notification' => "($provider->name) modified his own car",
            'sender'       => $provider->id,
            'user_id'      => '0',
            'lan'          => '2',
            'status'       => '0',
            'type'         => '4',
            'ar_id'        => $notification_ar->id
        ];
        Notification::create($data);
        if($request->file('image')){
            $path = 'images/car/';
            $files=$request->file('image');

            foreach($files as $file) {
 
                $input['image'] = $file->getClientOriginalName();
                $destinationPath = 'images/car/';
                
                $img = Image::make($file->getRealPath());
                $img->resize(800, 750, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path.$input['image']);
                $name = $path.$input['image'];
                CarImage::insert( [
                    'image'=>  $name,
                    'car_id'=> $car_ar->id,
                    'car_en_id'=> $car_en->id,
                ]);

            }
        }
        return response()->json([
            'status' => '1',
            'details'=> 'successfully update'
        ], 200);
    }
    //delete car by id
    public function destroy($car_id){
        $car = Car::where('id',$car_id)->first();
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car_id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
        }else{
            $car_en = Car::where('id',$car_id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
        }
        $car_en->delete();
        $car_ar->delete();
        return response()->json([
            'status' => '1',
            'details'=> 'successfully deleted'
        ], 200);
    }
    // provider Cars
    public function myCars($user_id , $lan){
        $cars = Car::where('provider_name',$user_id)->where('lan',$lan)->get();
        $car_details = [];
        foreach ($cars as $car){
            $images = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->first();
            $final  = array('id'=>$car->id,'name'=>$car->name,'price'=>$car->price_for_day,'bg_color'=>$car->color,'car_number'=>$car->number_of_car,'images'=>$images,'rating'=>$car->rating);
            array_push($car_details ,$final);
        }
        return response()->json([
            'status' => '1',
            'details'=> $car_details
        ]);
    }
    //return all type
    public function carType($lan){
        $cars = CarType::where('lan',$lan)->get();
        return response()->json([
            'status' => '1',
            'details'=> $cars
        ], 200);
    }
    //return all cars by specific type
    public function carsByType($type_id , $lan){
        $type = CarType::where('id',$type_id)->first();
        $cars = Car::where('type',$type->id)->where('lan',$lan)->orWhere('type',$type->ar_id)->where('lan',$lan)->paginate(3);

        $car_details = [];
        foreach ($cars as $car){
            if($car->ar_id == null){
                $car_ar = Car::where('id',$car->id)->first();
                $car_en = Car::where('ar_id',$car_ar->id)->first();
                $images = CarImage::where('car_id',$car->id)->where('car_id',$car_ar->id)->first();
                $final  = array('id'=>$car->id,'name'=>$car->name,'price'=>$car->price_for_day,'bg_color'=>$car->color,'car_number'=>$car->number_of_car,'booking_status'=>$car->booking_status,'images'=>$images,'rating'=>$car->rating);
                array_push($car_details ,$final);
            }else{
                $car_en = Car::where('id',$car->id)->first();
                $car_ar = Car::where('id',$car_en->ar_id)->first();
                $images = CarImage::where('car_id',$car_ar->id)->where('car_id',$car_ar->id)->first();
                $final  = array('id'=>$car->id,'name'=>$car->name,'price'=>$car->price_for_day,'bg_color'=>$car->color,'car_number'=>$car->number_of_car,'booking_status'=>$car->booking_status,'images'=>$images,'rating'=>$car->rating);
                array_push($car_details ,$final);
            }
        }
        return response()->json([
            'status' => '1',
            'details'=> $car_details
        ], 200);
    }
    //return car details
    public function carDetails($car_id,$lan){
        $car = Car::where('id',$car_id)->where('lan',$lan)->first();
        if($car == null){
            $car = Car::where('ar_id',$car_id)->where('lan',$lan)->first();
            if($car == null){
                $car_en = Car::where('id',$car_id)->first();
                $color  = Color::where('id',$car_en->color_id)->first();
                $car    = Car::where('id',$car_en->ar_id)->where('lan',$lan)->first();
                $images = CarImage::where('car_id',$car->id)->orWhere('car_id',$car->id)->get();
                $user   = User::where('id',$car->provider_name)->first();
            }
        }
        $color  = Color::where('id',$car->color_id)->first();
        $images = CarImage::where('car_id',$car->id)->orWhere('car_en_id',$car->id)->get();
        $user   = User::where('id',$car->provider_name)->first();


        $final = array('car'=>$car , 'images'=>$images,'user'=>$user,'color'=>$color);
        
        return response()->json([
            'status' => '1',
            'details' => $final
        ], 200);
    }  
    public function allCar($lan){
        $cars = Car::where('lan',$lan)->where('available','1')->get();
        
        $car_details =[];
        foreach($cars as $car){
            if($car->ar_id == null){
                $car_ar = Car::where('id',$car->id)->first();
                $car_en = Car::where('ar_id',$car_ar->id)->first();
                $images = CarImage::where('car_id',$car->id)->where('car_id',$car_ar->id)->get();
            }else{
                $car_en = Car::where('id',$car->id)->first();
                $car_ar = Car::where('id',$car_en->ar_id)->first();
                $images = CarImage::where('car_id',$car_ar->id)->where('car_id',$car_ar->id)->get();
            }
            $final = array('car'=>$car,'images'=>$images);
            array_push($car_details,$final);
        }
        return response()->json([
            'status' => '200',
            'details' =>$car_details
        ], 200);
    }
    public function editCar($car_id,$lan){
        if($lan == 1){
            $car_ar = Car::where('id',$car_id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
            $images = CarImage::where('car_id',$car_ar->id)->get();
            $color   = Color::where('id',$car_ar->color_id)->first();
        }else{
            $car_en = Car::where('id',$car_id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
            $images = CarImage::where('car_id',$car_ar->id)->get();
            $color   = Color::where('id',$car_ar->color_id)->first();
        }
        $final = array('car_en' => $car_en,'car_ar'=> $car_ar,'images'=> $images,'color'=>$color);
        return response()->json([
            'status' => '200',
            'details'=> $final
        ]);
        
        
    }
    public function deleteCarImage($image_id){
        $Car_image = CarImage::where('id',$image_id)->first();
        $carImages = CarImage::where('car_id',$Car_image->car_id)->get();
        if(count($carImages) == 1){
            return response()->json([
                'status'  => '404',
                'details' => 'you can not delete all images',
            ]);
        }else{
            $Car_image->delete();
            return response()->json([
                'status'  => '200',
                'details' => 'deleted successfuly'
            ]);
        }

    }
    public function carTypes($lan){
        $types = CarType::where('lan',$lan)->get();
        return response()->json([
            'status' => '200',
            'details'=> $types
        ]);  
    }
    public function carModels(Request $request){
        $type = CarType::find($request->type_id);
        if($type->ar_id == null){
            $models = CarModel::where('type',$request->type_id)->get();
        }else{
            $models = CarModel::where('type',$type->ar_id)->get();
        }

        return response()->json([
            'status' => '200',
            'details'=> $models
        ]);
    }
    public function colors(){
        $colors = Color::all();
        return response()->json([
            'status' => 200,
            'details'=> $colors
        ]);
    }
    public function countries(){
        $countries = Country::all();
        return response()->json([
            'status' => '200',
            'details'=> $countries
        ]);
    }
    public function cities(Request $request){
        $cities = City::where('country_id',$request->country_id)->get();
        return response()->json([
            'status' => '200',
            'details'=> $cities
        ]);
    }
}