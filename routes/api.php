<?php
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\AuthController;
    use App\Http\Controllers\Api\AdvertisingController;
    use App\Http\Controllers\Api\UserController;
    use App\Http\Controllers\Api\SearchController;
    use App\Http\Controllers\Api\ReviewController;
    use App\Http\Controllers\Api\CarController;
    use App\Http\Controllers\Api\BookingController;
    use App\Http\Controllers\Api\NotificationController;
    use App\Http\Controllers\Api\PrivacyController;
    use App\Http\Controllers\ForgotPasswordController;
    use App\Http\Controllers\ResetPasswordController;
/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'middleware' => 'api' , 'prefix' => 'auth' ] , function() {
    Route::post('/register' , [ AuthController::class , 'register']);
    Route::post('/login' , [ AuthController::class , 'login']);
    Route::post('/logout' , [ AuthController::class , 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::post('forgetPassword',[UserController::class,'forgetPassword']);
// start AdvertisingController
    Route::get('/AllAdvertising/{lan}',[AdvertisingController::class,'AllAdvertising']);
// end AdvertisingController

// start SearchController
    Route::post('/search/{lan}',[SearchController::class,'search']);
    Route::post('/advancedSearch/{lan}',[SearchController::class,'advancedSearch']);
// end SearchController

// start CarController
    Route::get('/allCar/{lan}',[CarController::class,'allCar']);
    Route::post('/car/store',[CarController::class,'store']);
    Route::post('/car/update/{car_id}',[CarController::class,'update']);
    Route::get('/destroy/{car_id}',[CarController::class,'destroy']);
    Route::get('/myCars/{user_id}/{lan}',[CarController::class,'myCars']);
    Route::get('/carType/{lan}',[CarController::class,'carType']);
    Route::get('/carsByType/{type_id}/{lan}',[CarController::class,'carsByType']);
    Route::get('/carDetails/{car_id}/{lan}',[CarController::class,'carDetails']);
    Route::get('/editCar/{car_id}/{lan}',[CarController::class,'editCar']);
    Route::get('/deleteCarImage/{image_id}',[CarController::class,'deleteCarImage']);
    Route::get('/carTypes/{lan}',[CarController::class,'carTypes']);
    Route::post('/carModels',[CarController::class,'carModels']);
    Route::get('/countries',[CarController::class,'countries']);
    Route::post('/cities',[CarController::class,'cities']);
// end CarController  

//start UserController
    Route::get('providerDetails/{user_id}',[UserController::class,'providerDetails']);
    Route::post('updateUser/{user_id}',[UserController::class,'updateUser']);
//end UserController

//start BookingController
    Route::get('historyBooking/{user_id}',[BookingController::class,'historyBooking']);
    Route::get('currentBooking/{user_id}',[BookingController::class,'currentBooking']);
    Route::post('sendBooking/{user_id}/{car_id}',[BookingController::class,'sendBooking']);
    Route::get('requestbooking/{provider_id}',[BookingController::class,'requestbooking']);
    Route::get('rejectBooking/{id}',[BookingController::class,'rejectBooking']);
    Route::post('changeStatus/{id}',[BookingController::class,'changeStatus']);
    Route::get('prossingBooking/{provider_id}',[BookingController::class,'prossingBooking']);
    Route::get('finishBooking/{provider_id}',[BookingController::class,'finishBooking']);
//end BookingController 

//start ReviewController
    Route::post('addCarReview/{user_id}',[ReviewController::class,'addCarReview']);
    Route::post('addCustomerReview/{user_id}',[ReviewController::class,'addCustomerReview']);
    Route::get('reviews/{provider_id}',[ReviewController::class,'reviews']);
//end ReviewController 
//start notification
    Route::get('myNotification/{user_id}/{lan}',[NotificationController::class,'myNotification']);
    Route::get('destroy_notification/{not_id}',[NotificationController::class,'destroy_notification']);
//end notification
//start privacy
    Route::get('privacy/{lan}',[PrivacyController::class,'privacy']);
    Route::post('sendMessage',[PrivacyController::class,'sendMessage']);
    Route::post('reply',[PrivacyController::class,'reply']);
    Route::get('aboutUs',[PrivacyController::class,'aboutUs']);
    Route::get('socialMedia',[PrivacyController::class,'socialMedia']);
    Route::get('/contactInformation',[PrivacyController::class,'contactInformation']);
//end privacy 
Route::get('colors',[CarController::class,'colors']);
Route::post('sendOtp',[LafahController::class,'sendOtp']);
Route::post('getCode',[LafahController::class,'getCode']);
