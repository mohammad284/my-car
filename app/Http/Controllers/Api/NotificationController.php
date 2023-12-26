<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
    use App\Models\Notification;
    use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function myNotification($user_id ,$lan){
        $notifications = Notification::where('user_id',$user_id)->where('lan',$lan)->paginate(10);
        return response()->json([
            'status'  => '1',
            'details' => $notifications 
        ], 200);
    }
    public function destroy_notification($not_id){
        $lan = app()->getLocale();

        $notidication = Notification::where('id',$not_id)->first();
        if($notidication->ar_id == null){
            $notidication_ar = Notification::where('id',$notidication->id)->first();
            $notidication_en = Notification::where('ar_id',$notidication_ar->id)->first();
            
        }else{
            $notidication_en = Notification::where('id',$notidication->id)->first();
            $notidication_ar = Notification::where('id',$notidication_en->ar_id)->first();

        }
        $notidication_ar->delete();
        $notidication_en->delete();

        return response()->json([
            'status' => '200',
            'details'=> 'deleted successfully'
        ]);
    }
}