<?php

namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\CustomerReview;
    use App\Models\Car;
    use App\Models\CarImage;
    use App\Models\User;
    use App\Models\CarType;
class ReviewController extends Controller
{
    public function addCarReview(Request $request,$user_id){
        $car = Car::find($request->car_id);
        $user = User::where('id',$user_id)->first();
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car->id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
        }else{
            $car_en = Car::where('id',$car->id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
        }
        $user_review = CustomerReview::where('user_id',$user_id)->where('car_id',$car_ar->id)->first();
        if( $user_review == null){
            $data = [
                'comment' =>$request->comment,
                'rate'    => $request->rate,
                'car_id'  =>$car_ar->id,
                'user_id' =>$user_id,
                'car_id_en'=>$car_en->id,
                'provider_id'=>$car->provider_name
            ];
            $review = CustomerReview::create($data);
            $data = [
                'notification' => "تم تقييم السيارة ($car->name) من قبل ($user->name)",
                'sender'       => $user->id,
                'user_id'      => 'admin',
                'type'         => '1',
                'lan'          => '1',
                'status'       => '0',
            ];
            $notification_ar = Notification::create($data);
            $data = [
                'notification' => "The car ($car->name) was evaluated by ($user->name)",
                'sender'       => $user->id,
                'user_id'      => 'admin',
                'lan'          => '2',
                'type'         => '1',
                'status'       => '0',
                'ar_id'        => $notification_ar->id
            ];
            Notification::create($data);
        }else{
            $data = [
                'comment' =>$request->comment,
                'rate'    => $request->rate,
                'car_id'  =>$request->car_id,
                'user_id' =>$user_id,
            ];
            $user_review->update($data);
        }
        $car_reviews = CustomerReview::where('car_id',$car_ar->id)->get();
        $count_car_reviews = count($car_reviews);
        $car_rate = CustomerReview::where('car_id',$car_ar->id)->sum('rate');
        $avg = $car_rate / $count_car_reviews;
        $car = Car::where('id',$car_ar->id)->first();
        if($car->ar_id == null){
            $car_ar = Car::where('id',$car->id)->first();
            $car_en = Car::where('ar_id',$car_ar->id)->first();
            $car_ar->rating = $avg;
            $car_ar->review_count = $count_car_reviews;
            $car_ar->save();
            $car_en->rating = $avg;
            $car_en->review_count = $count_car_reviews;
            $car_en->save();
        }else{
            $car_en = Car::where('id',$car->id)->first();
            $car_ar = Car::where('id',$car_en->ar_id)->first();
            $car_ar->rating = $avg;
            $car_ar->review_count = $count_car_reviews;
            $car_ar->save();
            $car_en->rating = $avg;
            $car_en->review_count = $count_car_reviews;
            $car_en->save();
        }
        return response()->json([
            'status' => '1',
            'details'=> 'successfully'
        ], 200);
    }
    public function addCustomerReview(Request $request , $user_id){
        $user_review = CustomerReview::where('user_id',$user_id)->where('car_id',$request->provider_id)->first();
        if( $user_review == null){
            $data = [
                'comment'     => $request->comment,
                'rate'        => $request->rate,
                'provider_id' => $request->provider_id,
                'user_id'     => $user_id,
            ];
            $review = CustomerReview::create($data);
        }else{
            $data = [
                'comment'     => $request->comment,
                'rate'        => $request->rate,
                'provider_id' => $request->provider_id,
                'user_id'     => $user_id,
            ];
            $user_review->update($data);
        }
        $provider_reviews = CustomerReview::where('provider_id',$request->provider_id)->get();
        $count_provider_reviews = count($provider_reviews);
        $provider_rate = CustomerReview::where('provider_id',$request->provider_id)->sum('rate');
        $avg = $provider_rate / $count_provider_reviews;
        $provider = User::where('id',$request->provider_id)->first();
        $provider->rating = $avg;
        $provider->save();
        return response()->json([
            'status' => '1',
            'details'=> 'successfully'
        ], 200);

    }

    public function reviews($provider_id){
        $reviews = CustomerReview::where('provider_id',$provider_id)->get();
        $review_details = [];
        foreach($reviews as $review){
            $car = Car::where('id',$review->car_id)->orWhere('ar_id',$review->car_id)->first();
            $user = User::where('id',$review->user_id)->first();
            $final = array('id'=>$review->id,'car_name'=>$car->name,'number_of_car'=>$car->number_of_car,'user_name'=>$user->name,'user_image'=>$user->image,'comment'=>$review->comment,'rate'=>$review->rate );
            array_push($review_details,$final);
        }
        return response()->json([
            'status' => '200',
            'details'=>$review_details
        ]);
    }
}
