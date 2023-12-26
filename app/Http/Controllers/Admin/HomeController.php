<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use App\Models\Admin;
use App\Models\ContactUs;
use App\Models\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon;
use Validator;
use App\Models\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $all_car = Car::where('lan',$lan)->get();
        $all = count($all_car);
        $booking_cars = Booking::where('status','prossing')->get();
        $booking = count($booking_cars);
        if(count($all_car) == 0){$result_count = 0 ;}else{$result_count = count($booking_cars)*100/count($all_car);}
        
        $result = (int)$result_count;
        $date   = now();
        $this_date = $date;
        $first  = now()->subDays(6);
        $second = now()->subDays(5);
        $third  = now()->subDays(4);
        $forth  = now()->subDays(3);
        $fifth  = now()->subDays(2);
        $sixth  = now()->subDays(1);
        $first_report  = Booking::whereDate('created_at', '=', date('Y-m-d'))->where('status','prossing')->sum('price');
        $second_report = Booking::whereBetween('created_at', [$sixth, $date])->where('status','prossing')->sum('price');          
        $third_report  = Booking::whereBetween('created_at', [$fifth, $sixth])->where('status','prossing')->sum('price');          
        $forth_report  = Booking::whereBetween('created_at', [$forth, $fifth])->where('status','prossing')->sum('price');          
        $fifth_report  = Booking::whereBetween('created_at', [$third, $forth])->where('status','prossing')->sum('price');          
        $sixth_report  = Booking::whereBetween('created_at', [$second, $third])->where('status','prossing')->sum('price');          
        $seven_report  = Booking::whereBetween('created_at', [$first, $second])->where('status','prossing')->sum('price');         

            
        $last_month = \Carbon\Carbon::now()->subMonth()->firstOfMonth();

        $this_month = $date;

        // First day of the last month.
        $first_last_month =  date('Y-m-01', strtotime($last_month));
        $last_first_piriod = date('Y-m-5', strtotime($last_month));
        $last_second_piriod = date('Y-m-10', strtotime($last_month));
        $last_third_piriod = date('Y-m-15', strtotime($last_month));
        $last_fifth_piriod = date('Y-m-20', strtotime($last_month));
        $last_sixth_piriod = date('Y-m-25', strtotime($last_month));
        $lastDayofLastMonth =    \Carbon\Carbon::parse($last_month)->endOfMonth()->toDateString();
        // First day of the this month.
        $first_this_month =  date('Y-m-01', strtotime($this_month));
        $first_piriod = date('Y-m-5', strtotime($this_month));
        $second_piriod = date('Y-m-10', strtotime($this_month));
        $third_piriod = date('Y-m-15', strtotime($this_month));
        $fifth_piriod = date('Y-m-20', strtotime($this_month));
        $sixth_piriod = date('Y-m-25', strtotime($this_month));
        $lastDayofThisMonth =    \Carbon\Carbon::parse($this_month)->endOfMonth()->toDateString();

        $first_report_last_month  = Booking::whereBetween('created_at', [$first_last_month, $last_first_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$first_last_month, $last_first_piriod])->sum('price');
        $second_report_last_month = Booking::whereBetween('created_at', [$last_first_piriod, $last_second_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$last_first_piriod, $last_second_piriod])->sum('price');
        $third_report_last_month  = Booking::whereBetween('created_at', [$last_second_piriod, $last_third_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$last_second_piriod, $last_third_piriod])->sum('price');
        $forth_report_last_month  = Booking::whereBetween('created_at', [$last_third_piriod, $last_fifth_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$last_third_piriod, $last_fifth_piriod])->sum('price');
        $fifth_report_last_month  = Booking::whereBetween('created_at', [$last_fifth_piriod, $last_sixth_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$last_fifth_piriod, $last_sixth_piriod])->sum('price');
        $sixth_report_last_month  = Booking::whereBetween('created_at', [$last_sixth_piriod, $lastDayofLastMonth])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$last_sixth_piriod, $lastDayofLastMonth])->sum('price');

        $first_report__month  = Booking::whereBetween('created_at', [$first_this_month, $first_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$first_this_month, $first_piriod])->sum('price');
        $second_report__month = Booking::whereBetween('created_at', [$first_piriod, $second_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$first_piriod, $second_piriod])->sum('price');
        $third_report__month  = Booking::whereBetween('created_at', [$second_piriod, $third_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$second_piriod, $third_piriod])->sum('price');
        $forth_report__month  = Booking::whereBetween('created_at', [$third_piriod, $fifth_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$third_piriod, $fifth_piriod])->sum('price');
        $fifth_report__month  = Booking::whereBetween('created_at', [$fifth_piriod, $sixth_piriod])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$fifth_piriod, $sixth_piriod])->sum('price');
        $sixth_report__month  = Booking::whereBetween('created_at', [$sixth_piriod, $lastDayofThisMonth])->where('status','finish')->orWhere('status','prossing')->whereBetween('created_at', [$sixth_piriod, $lastDayofThisMonth])->sum('price');
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $all_providers = User::where('type','provider')->where('status','1')->get();
        $all_users = User::where('type','user')->get();
        return view('dashboard.index',compact('result','sixth_report__month','fifth_report__month','forth_report__month','third_report__month','second_report__month','first_report__month','sixth_report_last_month','fifth_report_last_month','forth_report_last_month','third_report_last_month','second_report_last_month','first_report_last_month','all_providers','all_users','all','booking','date','first','second','third','forth','fifth','sixth','first_report','second_report','third_report','forth_report','fifth_report','sixth_report','seven_report','notifications','status_notification'));
    }
    // get notifications

    public function myAdmins(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $admins = Admin::all();
        return view('dashboard.admins',compact('notifications','status_notification','admins'));
    }
    public function addAdmin(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
            'type'      => ['required']
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $admin =  Admin::create([
            'name'          => $request['name'],
            'email'         => $request['email'],
            'password'      => Hash::make($request['password']),
            'type'         => $request['type'],
        ]);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','Added successfully');
        }else{
            return redirect()->back()->with('message','تم الإضافة بنجاح');
        }
    }
    public function deleteAdmin($admin_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $admins = Admin::all();
        if(count($admins) == 1){
            if($app_lan == 'en'){
                return redirect()->back()->with('message','there must be at least one admin');
            }else{
                return redirect()->back()->with('message','يجب ان يبقى على الأقل أدمن واحد');
            }
        }else{
            $admin = Admin::where('id',$admin_id)->first();
            $admin->delete();
            if($app_lan == 'en'){
                return redirect()->back()->with('message','deleted successfully');
            }else{
                return redirect()->back()->with('message','تم الحذف بنجاح');
            }
        }
    }
    public function updateAdmin(Request $request,$admin_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $admin = Admin::where('id',$admin_id)->first();

        if ($admin->email != $request->email) {
            $simular_email = Admin::where('email',$request->email)->get();
            if (count($simular_email) > 0) {
                return response()->json(['message' => 'email has taken']);
            }   
        }
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $data = [
            'name'          => $request['name'],
            'email'         => $request['email'],
            'password'      => Hash::make($request['password']),
            'type'          => $request['type'],
        ];
        $admin->update();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated successfully');
        }else{
            return redirect()->back()->with('message','تم التعديل بنجاح');
        }
    }

    public function contactMessage(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $messeges = ContactUs::all();
        $messege_details = [];
        foreach($messeges as $message){
            $user = User::where('id',$message->user_id)->first();
            $final = array('user'=>$user,'message'=>$message);
            array_push($messege_details,$final);
        }
        return view('dashboard.contact-message',compact('messege_details','notifications','status_notification'));
    }
    public function deleteMessage($msg_id){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $message = ContactUs::where('id',$msg_id)->first();
        $message->delete();
        if($app_lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
    public function replyMessage(Request $request,$msg_id){
        $message = ContactUs::find($msg_id);
        $message->reply  = $request->reply;
        $message->save();
        return redirect()->back();
    }
    public function welcomeEmails(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $welcome_emails = WelcomeEmail::all();
        return view('dashboard.welcome-emails.welcome-emails',compact('notifications','status_notification','welcome_emails'));
    }
    public function updateEmail(Request $request,$em_id){
        $lan = app()->getLocale();
        $email = WelcomeEmail::find($em_id);
        $email->email_ar = $request->email_ar;
        $email->email_en = $request->email_en;
        $email->save();
        if($lan == 'en'){
            return redirect()->back()->with('message','updated successfully');
        }else{
            return redirect()->back()->with('message','تم التعديل بنجاح');
        }
    }
}