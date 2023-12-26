<?php

namespace App\Http\Controllers\Api;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use App\Models\Percentage;
    use App\Models\WelcomeEmail;
    use App\Models\Notification;
    use Validator;
    use Image;
class AuthController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
            'mobile'    => ['required', 'unique:users'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        if ($request['image'] == NUll){
            $data['image'] = 'images/avatar.jpg';
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
        $percentage = Percentage::find('1');
        $user =  User::create([
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
            'lat'           => $request->lat,
            'percentage'    => $percentage->percentage
        ]);
        if($user->type == 'provider'){
            $data = [
                'notification' => "طلب ($user->name) التسجيل كمزود خدمة ",
                'sender'       => $user->id,
                'user_id'      => 'admin',
                'type'         => '1',
                'lan'          => '1',
                'status'       => '0',
            ];
            $notification_ar = Notification::create($data);
            $data = [
                'notification' => "Request ($user->name) to register as a service provider",
                'sender'       => $user->id,
                'user_id'      => 'admin',
                'lan'          => '2',
                'type'         => '1',
                'status'       => '0',
                'ar_id'        => $notification_ar->id
            ];
            Notification::create($data);
        }
        if($user->type == 'user'){
            $data = [
                'notification' => "قام ($user->name)بالتسجيل كمستخدم عادي",
                'sender'       => $user->id,
                'user_id'      => '0',
                'status'       => '1',
                'lan'          => '1',
                'status'       => '0',
            ];
            $notification_ar = Notification::create($data);
            $data = [
                'notification' => "($user->name) has registered as a user",
                'sender'       => $user->id,
                'user_id'      => '0',
                'lan'          => '2',
                'status'       => '0',
                'ar_id'        => $notification_ar->id
            ];
            Notification::create($data);
        }
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 200);

    }
    
    public function login(Request $request){
        $credentials = request(['email', 'password']);
        $token = auth()->guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){
        $WelcomeEmail = WelcomeEmail::where('title','auth')->first();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 20,
            'user' => auth('api')->user(),
            'message'=> $WelcomeEmail->email_ar
        ]);
    }  

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully logged out']);
    }
}
