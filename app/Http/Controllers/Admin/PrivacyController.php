<?php

namespace App\Http\Controllers\Admin;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\CarImage;
    use App\Models\User;
    use App\Models\CarType;
    use App\Models\SocialMedia;
    use App\Models\ContactInformation;
    use App\Models\CustomerReview;
    use App\Models\Car;
    use Validator;
    use Image;
    use App\Models\Notification;
    use App\Models\Percentage;
    use App\Models\Booking;
    use App\Models\Privacy;
    use App\Models\AboutUs;
class PrivacyController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function privacy(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $privacy_ar =  Privacy::where('lan','1')->first();
        $privacy_en =  Privacy::where('lan','2')->first();
        $type = 1;
        return view('dashboard.privacy.term',compact('notifications','status_notification','privacy_ar','privacy_en','type'));
    }
    public function Terms(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $privacy_ar =  Privacy::where('lan','1')->first();
        $privacy_en =  Privacy::where('lan','2')->first();
        $type = 2;
        return view('dashboard.privacy.term',compact('notifications','status_notification','privacy_ar','privacy_en','type'));
    }
    public function updatePrivacy(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }

        $privacy_ar_lan = Privacy::where('lan','1')->first();
        $privacy_en_lan = Privacy::where('lan','2')->first();
        $data_ar = [
            'privacy_policy'  => $request->privacy_ar,
            'Terms'           => $request->term_ar
        ];
        $data_en = [
            'privacy_policy'  => $request->privacy_en,
            'Terms'     => $request->term_en
        ];

        $privacy_ar_lan->update($data_ar);
        $privacy_en_lan->update($data_en);
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated seccessfully');
        }else{
            return redirect()->back()->with('message','تم تعديل البيانات بنجاح ');
        }
    }
    public function aboutUs(){

        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $abouts = AboutUs::all();
        return view('dashboard.privacy.about-us',compact('notifications','status_notification','abouts'));
    }
    public function updateAboutUs(Request $request){
        $lan = app()->getLocale();
        $validator = Validator::make($request->all(), [
            'email_support' => ['required'],
            'mobile'        => ['required'],
            'about_ar'      => ['required'],
            'about_en'      => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/about/';
            $destinationPath = 'images/about';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  $name;
        }
        $data = [
            'email_support' => $request->email_support,
            'mobile'        => $request->mobile,
            'phone'         => $request->phone,
            'about_ar'      => $request->about_ar,
            'about_en'      => $request->about_en,
            'logo'          => $data['image']
        ];

        $id = 1;
        $about = AboutUs::find($id);
        $about->update($data);
        if($lan == 'en'){
            return redirect()->back()->with('message','updated successfully');
        }else{
            return redirect()->back()->with('message','تم التعديل بنجاح');
        }
    }
    public function percentage(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $percentages = Percentage::all();
        return view('dashboard.privacy.percentage',compact('notifications','status_notification','percentages'));
    }
    public function updatePercentage(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $percentages = Percentage::all();
        foreach($percentages as $percentage){
            $percentage->percentage = $request->percentage;
            $percentage->update();
        }
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated seccessfully');
        }else{
            return redirect()->back()->with('message','تم تعديل البيانات بنجاح ');
        }
    }
    public function socialMedia(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $social_media = SocialMedia::all();
        return view('dashboard.privacy.social-media',compact('notifications','status_notification','social_media'));
    }
    public function updatesocialMedia(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $social_media = SocialMedia::all();
        foreach($social_media as $social){
            $social->face_book = $request->face_book;
            $social->whatsapp  = $request->whatsapp;
            $social->twitter   = $request->twitter;
            $social->Instagram = $request->Instagram;
            $social->telegram  = $request->telegram;
            $social->update();
        }
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated seccessfully');
        }else{
            return redirect()->back()->with('message','تم تعديل البيانات بنجاح ');
        }
    }
    public function contactInformation(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $contact_information = ContactInformation::all();
        return view('dashboard.privacy.contact-information',compact('notifications','status_notification','contact_information'));
    }
    public function updatecontactnformation(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $contact_information = ContactInformation::all();
        foreach($contact_information as $information){
            $information->mobile = $request->mobile;
            $information->phone  = $request->phone;
            $information->email   = $request->email;
            $information->location = $request->location;
            $information->update();
        }
        if($app_lan == 'en'){
            return redirect()->back()->with('message','updated seccessfully');
        }else{
            return redirect()->back()->with('message','تم تعديل البيانات بنجاح ');
        }
    }
}
