<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Privacy;
use App\Models\ContactUs;
use App\Models\ContactInformation;
use App\Models\AboutUs;
use App\Models\SocialMedia;
class PrivacyController extends Controller
{
    public function privacy($lan){

        $privacy =  Privacy::where('lan',$lan)->first();
        return response()->json([
            'status'  => '200',
            'details' => $privacy
        ]);
    }
    public function contactUs(Request $request){
        $data = [
            'user_id' => $request->User_id,
            'message' => $request->message
        ];
        return response()->json([
            'status'  => '200',
            'details' => 'successfully'
        ]);
    }
    public function sendMessage(Request $request){
     
        $data = [
            'message'  => $request-> message,
            'user_id'  => $request-> user_id,
        ];
        ContactUs::create($data);
        return response()->json([
            'status' => '200',
            'details'=> $data
        ]);
    }
    public function reply(Request $request){
        $contact = ContactUs::where('user_id',$request->user_id)->orderBy('created_at','Desc')->get();
        return response()->json([
            'status' => '200',
            'details'=> $contact
        ]);
    }
    public function aboutUs(){
        $data = AboutUs::all();
        return response()->json([
            'status' => 200,
            'details'=>$data
        ]);
    }
    public function socialMedia(){
        $social_media = SocialMedia::all();
        return response()->json([
            'status'  => '200',
            'details' => $social_media
        ]);
    }
    public function contactInformation(){
        $contact_information = ContactInformation::all();
        return response()->json([
            'status'  => '200',
            'details' => $contact_information
        ]);
    }
}
