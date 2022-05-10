<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\AuthUserTrait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use AuthUserTrait;
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register']]);
        return auth()->shouldUse('api');
    }

    public function login(){
        $credentials = request(['email','password']);
        if(! $token = auth()->attempt($credentials)){
            return response()->json(['error'=>'Unauthorized'],401);
        }
        return $this->responseWithToken($token);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|numeric|unique:users|min:9',
            'alamat' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages(),422);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->role = "member";
        $user->alamat = $request->alamat;
        $user->password = Hash::make(request('password'));
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
        return response()->json(['message'=>'Successfully Register!'],201);
    }

    public function responseWithToken($token)
    {
        return response()->json([
        'access_token'=> $token,
        'token_type'=> 'bearer',
        'expires'=> auth()->factory()->getTTL() * 60,
        ]);
    }

    public function logout(){
        return $this->responseWithToken(auth()->refresh(true,true));
    }
}
