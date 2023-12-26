<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Notification;
use App\Models\Color;
class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function colors(){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $notifications = Notification::where('lan',$lan)->orderBy('created_at', 'desc')->take(5)->get();
        $status_notification = 1;
        foreach($notifications as $notification){
             
            if($notification->status == 0){$status_notification = 0;}
        }
        $colors = Color::all();
        return view('dashboard.color.colors',compact('notifications','status_notification','colors'));
    }
    public function add_color(Request $request){
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [
            'color'      => ['required'],
            'color_ar'   => ['required'],
            'color_en'   => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $data = [
            'color'    => $request->color,
            'color_ar' => $request->color_ar,
            'color_en' => $request->color_en
        ];
        Color::create($data);
        if($lan == 'en'){
            return redirect('/admin/colors')->with('message','added successfully');
        }else{
            return redirect('/admin/colors')->with('message','تم إضافة اللون بنجاح');
        }
    }
    public function updateColor(Request $request,$color_id){
        $color = Color::find($color_id);
        $app_lan = app()->getLocale();
        if($app_lan == 'ar'){ $lan = '1';};
        if($app_lan == 'en'){ $lan = '2';};
        $validator = Validator::make($request->all(), [
            'color'      => ['required'],
            'color_ar'   => ['required'],
            'color_en'   => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $data = [
            'color'    => $request->color,
            'color_ar' => $request->color_ar,
            'color_en' => $request->color_en
        ];
        $color->update($data);
        if($lan == 'en'){
            return redirect('/admin/colors')->with('message','updated successfully');
        }else{
            return redirect('/admin/colors')->with('message','تم التعديل بنجاح');
        }
    }
    public function deletColor($color_id){
        $lan = app()->getLocale();
        $color = Color::where('id',$color_id)->delete();
        if($lan == 'en'){
            return redirect()->back()->with('message','deleted successfully');
        }else{
            return redirect()->back()->with('message','تم الحذف بنجاح');
        }
    }
}
