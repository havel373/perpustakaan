<?php

namespace App\Http\Controllers\Office;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:office')->except('do_logout');
    }

    public function index()
    {
        return view('pages.office.auth.main');
    }

   public function do_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }else{
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            }
        }
        $check = User::where("email", $request->email)->where('role', '!=','member')->first();
        $user = $request->all();
        if ($check) {
            if (Auth::guard('office')->attempt($user)) {
                return response()->json([
                    'alert' => 'success',
                    'message' => 'Selamat Datang Kembali ' . Auth::guard('office')->user()->name,
                ]);
            }
            else {
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Password salah!',
                ]);
            }
        }else{
            return response()->json([
                'alert' => 'error',
                'message' => 'email tidak ditemukan!',
            ]);
        }
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function do_logout()
    {
        $employee = Auth::guard('office')->user();
        Auth::logout($employee);
        return redirect()->route('office.auth.index');
    }
}
