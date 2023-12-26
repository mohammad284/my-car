<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Validator;
use Image;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function providerDetails($user_id){
        $user = User::find($user_id);
        return response()->json([
            'status' =>'1',
            'details' => $user
        ], 200);
    }
    public function updateUser(Request $request , $user_id){
        $user = User::where('id',$user_id)->first();
        if ($user->email != $request->email) {
            $simular_email = User::where('email',$request->email)->get();
            if (count($simular_email) > 0) {
                return response()->json(['message' => 'email has taken']);
            }   
        }
        
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'mobile'    => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        if ($request['image'] == NUll){
            $data['image'] = $user->image;
        }
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/user/';
            $destinationPath = 'images/user';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  $name;
          }
          
          if($request->password != null){
            if (Hash::check($request->old_password, $user->password)) { 
             } else {
                return response()->json(['message' => 'Password does not match']);
             }
             $validator = Validator::make($request->all(), [
                'password'  => ['required', 'string', 'min:6'],
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
             $data = [
                'name'          => $request['name'],
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
                'password'      => Hash::make($request['password']),
                'status'        => '0',
                'type'          => $request->type,
                'company_name'  => $request->company_name,
                'cr_number'     => $request->cr_number,
                'total_car'     => $request->total_car,
                'available_car' => $request->available_car,
                'image'         => $data['image'],
                'provider_address'=>$request->provider_address,
                'lan'           => $request->lan,
                'lat'           => $request->lat
               ];
          }else{
            $data = [
                'name'          => $request['name'],
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
                'status'        => '0',
                'type'          => $request->type,
                'company_name'  => $request->company_name,
                'cr_number'     => $request->cr_number,
                'total_car'     => $request->total_car,
                'available_car' => $request->available_car,
                'image'         => $data['image'],
                'provider_address'=>$request->provider_address,
                'lan'           => $request->lan,
                'lat'           => $request->lat
               ];
          }


            $data = [
                'notification' => "قام ($user->name)بتعديل البروفايل الخاص به",
                'sender'       => $user->id,
                'user_id'      => '0',
                'type'         => '1',
                'lan'          => '1',
                'status'       => '0',
            ];
            $notification_ar = Notification::create($data);
            $data = [
                'notification' => "($user->name) modified his profile",
                'sender'       => $user->id,
                'user_id'      => '0',
                'lan'          => '2',
                'type'         => '1',
                'status'       => '0',
                'ar_id'        => $notification_ar->id
            ];
            Notification::create($data);

           $user->update($data);
           return response()->json([
            'status' => '200',
            'message' => 'updated successfully',
            'user' => $user
        ], 200);
    }
    public function forgetPassword() {
        $credentials = request()->validate(['email' => 'required|email']);
        $user = User::where('email',$credentials['email'])->first();
        if($user ==null){
            return response()->json('الايميل غير مسجل');
        }
        Password::sendResetLink($credentials);
        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }
}

