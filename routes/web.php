<?php
// admin controller
  use Illuminate\Support\Facades\Route;
  use App\Http\Controllers\Admin\HomeController;
  use App\Http\Controllers\Admin\Auth\LoginController;
  use App\Http\Controllers\Admin\AdvertisingController;
  use App\Http\Controllers\Admin\UserController;
  use App\Http\Controllers\Admin\IndexController;
  use App\Http\Controllers\Admin\CarController;
  use App\Http\Controllers\Admin\BookingController;
  use App\Http\Controllers\Admin\ReviewController;
  use App\Http\Controllers\Admin\EarningController;
  use App\Http\Controllers\Admin\FinancialReportController; 
  use App\Http\Controllers\Admin\PrivacyController; 
  use App\Http\Controllers\Admin\NotificationController; 
  use App\Http\Controllers\Admin\LocationController; 
  use App\Http\Controllers\Admin\ColorController; 
  // end admin controller  
  use App\Http\Controllers\Provider\CarProviderController; 
  use App\Http\Controllers\Provider\AdvertisingProviderController; 
  use App\Http\Controllers\Provider\NotificationProviderController;
  use App\Http\Controllers\Provider\RentalController;  
  use App\Http\Controllers\Provider\ReportProviderController;

//front controller 
use App\Http\Controllers\IndexFrontController;
use App\Http\Controllers\GalleryFrontController;
use App\Http\Controllers\ReviewFrontController;
use App\Http\Controllers\AboutFrontController;
use App\Http\Controllers\userFrontController;
use App\Http\Controllers\Auth\LoginFrontController;
use App\Http\Controllers\SearchFrontController;
use App\Http\Controllers\ReservationFrontController;
use App\Http\Controllers\Auth\RegisterController;
//end front controller  ProviderController
use App\Http\Controllers\Provider\Auth\LoginProviderController;
use App\Http\Controllers\Provider\ProviderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/resetPassword',[userFrontController::class,'resetPassword']);
Auth::routes();
Route::namespace("Admin")->prefix('admin')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('admin.home');

    Route::namespace('Auth')->group(function(){
      Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login');
      Route::post('/login',[LoginController::class,'login']);
      Route::post('/logout',[LoginController::class,'logout'])->name('admin.logout');
    });

    Route::get('/myAdmins',[HomeController::class,'myAdmins']);
    Route::get('/deleteAdmin/{admin_id}',[HomeController::class,'deleteAdmin']);
    Route::post('/addAdmin',[HomeController::class,'addAdmin']);
    Route::post('/updateAdmin/{admin_id}',[HomeController::class,'updateAdmin']);
    // start index 
      Route::get('/index',[HomeController::class,'carsReport']);
    //end index 
    
    // start privacy 
      Route::get('/privacy',[PrivacyController::class,'privacy']);
      Route::get('/Terms',[PrivacyController::class,'Terms']);
      Route::get('/aboutUs',[PrivacyController::class,'aboutUs']);
      Route::post('/updateAboutUs',[PrivacyController::class,'updateAboutUs']);
    // end privacy

    // start percentage 
    Route::get('/percentage',[PrivacyController::class,'percentage']);
    Route::post('/updatePercentage',[PrivacyController::class,'updatePercentage']);
    // end percentage

    // start  socialMedia contactnformation
    Route::get('/socialMedia',[PrivacyController::class,'socialMedia']);
    Route::post('/updatesocialMedia',[PrivacyController::class,'updatesocialMedia']);
    // end socialMedia
    // start  contactnformation
    Route::get('/contactInformation',[PrivacyController::class,'contactInformation']);
    Route::post('/updatecontactnformation',[PrivacyController::class,'updatecontactnformation']);
    // end contactnformation
      Route::post('/updatePrivacy',[PrivacyController::class,'updatePrivacy']);
    // start advirtising 
      Route::get('/addAdvirtising',[AdvertisingController::class,'showAddForm']);
      Route::get('/allAdvirtising',[AdvertisingController::class,'allAdvirtising']);
      Route::post('/storeAdvertising',[AdvertisingController::class,'storeAdvertising']);
      Route::get('/editAdvertising/{ad_id}',[AdvertisingController::class,'editAdvertising']);
      Route::post('/updateAdvertising/{ad_id}',[AdvertisingController::class,'updateAdvertising']);
      Route::post('/changeProvider',[AdvertisingController::class,'changeProvider'])->name('change_select');
      Route::get('/removeAdvertising/{ad_id}',[AdvertisingController::class,'removeAdvertising']);
    //end advertising 
    
    // locations
      Route::get('/countries',[LocationController::class,'countries']);
      Route::get('/cities',[LocationController::class,'cities']);
      Route::get('/deleteLocation/{loc_id}',[LocationController::class,'deleteLocation']);
      Route::post('/addCountry',[LocationController::class,'addCountry']);
      Route::post('/addCity',[LocationController::class,'addCity']);
      Route::post('/updateCountry/{city_id}',[LocationController::class,'updateCountry']);
      Route::post('/updateCity/{city_id}',[LocationController::class,'updateCity']);
    // locations 

    // welcomeEmails
      Route::get('/welcomeEmails',[HomeController::class,'welcomeEmails']);
      Route::post('/updateEmail/{em_id}',[HomeController::class,'updateEmail']);
    // welcomeEmails 

    // start car
      Route::get('/addCarType',[CarController::class,'addCarType']);
      Route::get('/allCars',[CarController::class,'allCars']);
      Route::get('/editCarType/{type_id}',[CarController::class,'editCarType']);
      Route::get('/allCarsType',[CarController::class,'allCarsType']);
      Route::post('/storeCarType',[CarController::class,'storeCarType']);
      Route::post('/updateCarType/{type_id}',[CarController::class,'updateCarType']);
      Route::get('/removeCarType/{type_id}',[CarController::class,'removeCarType']);
      Route::get('/addNewCar',[CarController::class,'addCar']);
      Route::post('/storeCar',[CarController::class,'store']);
      Route::get('/categoryCars/{car_id}',[CarController::class,'categoryCars']);
      Route::get('/removeCar/{car_id}',[CarController::class,'removeCar']);
      Route::get('/editCar/{car_id}',[CarController::class,'editCar']);
      Route::post('/updateCar/{car_id}',[CarController::class,'updateCar']);
      Route::get('/carmodel',[CarController::class,'carmodel']);
      Route::post('/addModel',[CarController::class,'addModel']);
      Route::post('/updateModel/{car_id}',[CarController::class,'updateModel']);
      Route::get('/deleteModel',[CarController::class,'deleteModel']);
      Route::get('/activeCar/{car_id}',[CarController::class,'activeCar']);
      Route::post('/changeBrand',[CarController::class,'changeBrand']);
    //end car   
    
    // start user&provider controller 
      Route::post('/addProvider',[UserController::class,'addProvider']);
      Route::get('/deleteProvider/{provider_id}',[UserController::class,'deleteProvider']);
      Route::get('/allprovider',[UserController::class,'allprovider']);
      Route::get('/requestProvider',[UserController::class,'requestProvider']);
      Route::get('/allUser',[UserController::class,'allUser']);
      Route::post('/acceptUser/{user_id}',[UserController::class,'acceptUser']);
      Route::post('/blockProvider/{provider_id}',[UserController::class,'blockProvider']);
      Route::get('/blockedAccount',[UserController::class,'blockedAccount']);
      Route::get('/activeAccount/{user_id}',[UserController::class,'activeAccount']);
      Route::get('/moreDetails/{provider_id}',[UserController::class,'providerDetails']);
      Route::get('/editProvider/{provider_id}',[UserController::class,'editProvider']);
      Route::post('/updateProvider/{provider_id}',[UserController::class,'updateProvider']);
      Route::get('/edituser/{user_id}',[UserController::class,'edituser']);
      Route::post('/updateUser/{user_id}',[UserController::class,'updateUser']);
      Route::get('/deleteUser/{user_id}',[UserController::class,'deleteUser']);
      Route::post('/changeCity',[UserController::class,'changeCity'])->name('change_city');
    //end user&provider controller  

    // start reviews
      Route::get('/reviews',[CarController::class,'allReviews']);
      Route::get('/carReview/{car_id}',[CarController::class,'carReview']);
      Route::get('/ediReview/{review_id}',[ReviewController::class,'ediReview']);
      Route::post('/updateReview/{review_id}',[ReviewController::class,'updateReview']);
    //end reviews 

    // start financialReportFilter 
      Route::post('/carReportFilter',[FinancialReportController::class,'carReportFilter']);
      Route::post('/financialReportFilter',[FinancialReportController::class,'financialReportFilter']);
      Route::post('/printfilterCarReport',[FinancialReportController::class,'printfilterCarReport']);
      Route::post('/printfilterFinancialReport',[FinancialReportController::class,'printfilterFinancialReport']);
      Route::post('/financialReportFilter',[FinancialReportController::class,'financialReportFilter']);
      Route::get('/autoReports',[FinancialReportController::class,'autoReports']);
      Route::get('/financialReports',[FinancialReportController::class,'financialReports']);
      Route::get('/autoDetailstoday/{provider_id}',[FinancialReportController::class,'autoDetailstoday']);
      Route::get('/autoDetailsweek/{provider_id}',[FinancialReportController::class,'autoDetailsweek']);
      Route::get('/autoDetailsMonth/{provider_id}',[FinancialReportController::class,'autoDetailsMonth']);
    //end FinancialReport  

    // notifications 
    Route::get('/notifications',[NotificationController::class,'notifications']);
    Route::get('/deleteNotification/{not_id}',[NotificationController::class,'deleteNotification']);
    Route::get('/sendNotifications',[NotificationController::class,'sendNotifications']);
    Route::get('/appNotification',[NotificationController::class,'appNotification']);
    Route::post('/sendTextNotification',[NotificationController::class,'sendTextNotification']);
    Route::post('/updateNotification/{not_id}',[NotificationController::class,'updateNotification']);
    
    // notifications 
    Route::get('/contactMessage',[HomeController::class,'contactMessage']);
    Route::get('/deleteMessage/{msg_id}',[HomeController::class,'deleteMessage']);
    Route::post('/replyMessage/{msg_id}',[HomeController::class,'replyMessage']);
    // start print
      Route::get('/printTodayCarReport',[FinancialReportController::class,'printTodayCarReport']);
      Route::get('/printWeekCarReport',[FinancialReportController::class,'printWeekCarReport']);
      Route::get('/printMonthCarReport',[FinancialReportController::class,'printMonthCarReport']);

      Route::get('/printTodayFinancialReport',[FinancialReportController::class,'printTodayFinancialReport']);
      Route::get('/printWeekFinancialReport',[FinancialReportController::class,'printWeekFinancialReport']);
      Route::get('/printMonthFinancialReport',[FinancialReportController::class,'printMonthFinancialReport']);

      Route::get('/printTodayProviderEarning',[EarningController::class,'printTodayProviderEarning']);
      Route::get('/printWeekProviderEarning',[EarningController::class,'printWeekProviderEarning']);
      Route::get('/printMonthProviderEarning',[EarningController::class,'printMonthProviderEarning']);
    //end print
    // start booking
    Route::get('/providerBooking',[BookingController::class,'providerBooking']);
    //end booking
    //provider earnings
    Route::get('/providerPercentage',[EarningController::class,'providerPercentage']);
    //end earnings 
  // color
  Route::get('/colors',[ColorController::class,'colors']);
  Route::post('/addColor',[ColorController::class,'add_color']);
  Route::post('/updateColor/{color_id}',[ColorController::class,'updateColor']);
  Route::get('/deletColor/{color_id}',[ColorController::class,'deletColor']);
  //color 

});
Route::name('provider.')->namespace('Provider')->prefix('provider')->group(function(){

  Route::namespace('Auth')->middleware('guest:provider')->group(function(){
    Route::get('/login',[LoginProviderController::class,'showLoginForm'])->name('provider.login');
    Route::post('/login',[LoginProviderController::class,'login']);
    Route::get('/providerlogout',[LoginProviderController::class,'logout'])->name('provider.logout');
  });
  Route::get('/allPartner',[ProviderController::class,'allPartner']);
  Route::get('/addPartner',[ProviderController::class,'addPartner']);
  Route::post('/storePartner',[ProviderController::class,'storePartner']);
  Route::get('/index',[ProviderController::class,'index'])->name('provider.home');
  Route::get('/allAdvirtising',[AdvertisingProviderController::class,'all_advirtising']);
  Route::get('/allCars',[CarProviderController::class,'allCars']);
  Route::get('/addNewCar',[CarProviderController::class,'addCar']);
  Route::post('/storeCar',[CarProviderController::class,'store']);
  Route::get('/editCar/{car_id}',[CarProviderController::class,'editCar']);
  Route::post('/storer',[CarProviderController::class,'store']);
  Route::post('/updateCar/{car_id}',[CarProviderController::class,'updateCar']);
  Route::get('/removeCar/{car_id}',[CarProviderController::class,'removeCar']);
  Route::get('/reviews',[CarProviderController::class,'allReviews']);
  Route::get('/carReview/{car_id}',[CarProviderController::class,'carReview']);
  Route::get('/notifications',[NotificationProviderController::class,'notifications']);

  Route::get('/manualRental',[RentalController::class,'munual_rental']);
  Route::post('/rental',[RentalController::class,'rental']);
  Route::post('/changecity',[RentalController::class,'changecity']);
  Route::get('/providerBooking',[RentalController::class,'providerBooking']);
  Route::get('/deleteBooking/{booking_id}',[RentalController::class,'deleteBooking']);
  Route::get('/changeStatus/{booking_id}',[RentalController::class,'changeStatus']);
  Route::post('/changebrand',[RentalController::class,'changebrand']);
  Route::get('/allRental',[RentalController::class,'allRental']);
  Route::get('/changeRentalStatus/{rent_id}',[RentalController::class,'changeRentalStatus']);
  Route::post('/rentalFilter',[RentalController::class,'rentalFilter']);
  // start financialReportFilter 

    Route::post('/financialReportFilter',[ReportProviderController::class,'financialReportFilter']);
    Route::get('/autoReports',[ReportProviderController::class,'autoDetails']);
    Route::get('/financialReports',[ReportProviderController::class,'financialReports']);
    Route::post('/carReportFilter',[ReportProviderController::class,'carReportFilter']);
    Route::post('/financialFilter',[ReportProviderController::class,'financialFilter']);
    // Route::get('/autoDetailsweek/{provider_id}',[ReportProviderController::class,'autoDetailsweek']); financialFilter
    // Route::get('/autoDetailsMonth/{provider_id}',[ReportProviderController::class,'autoDetailsMonth']);
  //end FinancialReport  
});
Route::get('/change-language/{locale}', function ($locale) {
  App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

/// ########## front-end route
  ## login front route 
    Route::get('/showAddLogin',[userFrontController::class,'showAddLogin']);
    Route::post('/login',[LoginFrontController::class,'login']);
    Route::post('/register',[RegisterController::class,'register']);
    Route::get('/logout',[LoginFrontController::class,'logout']);
  ## about front route

  ## index front route
    Route::get('/',[IndexFrontController::class,'index']);
    Route::get('/index2',[IndexFrontController::class,'index2']);
  ## gallery front route 
    Route::get('/gallery',[GalleryFrontController::class,'gallery']);
    Route::post('/details',[GalleryFrontController::class,'details']);

  ## gallery front route 

  ## review front route 
    Route::get('/allReview',[ReviewFrontController::class,'review']);
  ## review front route 

  ## about front route 
    Route::get('/about',[AboutFrontController::class,'about']);
  ## about front route 

  ## search front route 
    Route::post('/search',[SearchFrontController::class,'search']);
    Route::post('/searchFiltter',[SearchFrontController::class,'searchFiltter']);
    Route::post('/advancedSearch',[SearchFrontController::class,'advancedSearch']);
  ## search front route 
  ## reservation front route 
    Route::post('/reservation',[ReservationFrontController::class,'reservation']);
    Route::post('/sendBooking/{car_id}',[ReservationFrontController::class,'sendBooking']);
  ## reservation front route 
  ## contact us
    Route::get('/contactUs',[IndexFrontController::class,'contactUs']);
  ## contact us
  Route::get('/allAdvertising',[IndexFrontController::class,'allAdvertising']);
  Route::get('/privacy',[IndexFrontController::class,'privacy']);
  Route::get('/account',[IndexFrontController::class,'account']);
  Route::get('/editAccount',[IndexFrontController::class,'editAccount']);
  Route::post('/updateAccount',[IndexFrontController::class,'updateAccount']);