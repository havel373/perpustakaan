<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware(function ($request,$next) {
            $role = Auth::user()->role;
            if($role != 'superadmin'){
                abort(403);
            }
            return $next($request);
        });
    }
    
    public function index(Request $request)
    {
        if($request->ajax() ){
            $keywords = $request->keywords;
            $collection = User::where('role', '!=', 'member')
            ->where(function($query) use ($keywords){
                $query->where('name','like','%'.$keywords.'%');
                $query->orWhere('email','like','%'.$keywords.'%');
                $query->orWhere('no_hp','like','%'.$keywords .'%');
            })
            ->paginate(5);
            return view('pages.office.admin.list', compact('collection'));    
        }
        return view('pages.office.admin.main');
    }

    public function create()
    {
        return view('pages.office.admin.input',["admin"=> new User]);
    }

    public function store(Request $request, User $admin)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'alamat' => 'required',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|numeric|unique:users',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('name')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            }else if($errors->has('alamat')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('alamat'),
                ]);
            }else if($errors->has('email')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }else if($errors->has('no_hp')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_hp'),
                ]);
            }else if($errors->has('role')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('role'),
                ]);
            }else if($errors->has('password')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            }
        }
        $admin = new User;
        $admin->name = Str::title($request->name);
        $admin->alamat = $request->alamat;
        $admin->email = $request->email;
        $admin->no_hp = $request->no_hp;
        $admin->role = $request->role;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Admin '. $request->name . ' Tersimpan',
        ]);   
    }

    public function show(User $admin)
    {
        //
    }
  
    public function edit(User $admin)
    {
        return view('pages.office.admin.input',compact('admin'));
    }

   
    public function update(Request $request, User $admin)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'alamat' => 'required',
            'email' => 'required|email|unique:users,email,'.$admin->id,
            'no_hp' => 'required|numeric|unique:users,no_hp,'.$admin->id,
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('name')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            }else if($errors->has('alamat')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('alamat'),
                ]);
            }else if($errors->has('email')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }else if($errors->has('no_hp')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_hp'),
                ]);
            }else if($errors->has('role')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('role'),
                ]);
            }
        }
        $admin->name = Str::title($request->name);
        $admin->alamat = $request->alamat;
        $admin->email = $request->email;
        $admin->no_hp = $request->no_hp;
        $admin->role = $request->role;
        $admin->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Admin '. $request->name . ' Diubah',
        ]);   
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Admin '. $admin->name . ' Dihapus',
        ]);
    }
}
