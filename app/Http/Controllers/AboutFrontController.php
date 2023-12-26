<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AboutFrontController extends Controller
{
    public function about(){
        $login = Auth::user(); 
        if ($login == null ){
            return view('front-end.about');
        }else{
            $user = User::find(Auth::user()->id);
            return view('front-end.about',compact('user'));
        }
    }
}
