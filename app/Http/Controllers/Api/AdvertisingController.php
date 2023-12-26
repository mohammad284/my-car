<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertising;
use Image;
class AdvertisingController extends Controller
{
    public function AllAdvertising($lan){
        $AllAdvertising = Advertising::where('lan',$lan)->paginate(2);
        return response()->json([
            'status' => '1',
            'details'=> $AllAdvertising
        ], 200);
    }

}
