<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userFrontController extends Controller
{
    public function showAddLogin(){
        return view('front-end.login');
    }
    public function resetPassword(Request $request){
        
        $data = request()->validate([
            'email' => 'min:2',
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::where('email',$request->email)->first();
        
        $user->password = $request->password;
        $user->save();
        return redirect ('/login')->with('message','تم تعديل كلمة المرور');
    }
}
