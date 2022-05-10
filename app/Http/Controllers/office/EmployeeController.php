<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax() )
        {
            $keywords = $request->keywords;
            $collection = User::where('role', '!=','member')
            ->where('role', '!=','superadmin')
            ->where(function($query) use ($keywords){
                $query->where('name','like','%'.$keywords.'%');
                $query->orWhere('email','like','%'.$keywords.'%');
                $query->orWhere('no_hp','like','%'.$keywords .'%');
            })
            ->paginate(5);
            return view('pages.office.employee.list',compact('collection'));
        }
        return view('pages.office.employee.main');
    }

    public function create()
    {
        return view('pages.office.employee.modal', ["employee"=> new User]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'alamat' => 'required',
            'email' => 'required|unique:users|email',
            'no_hp' => 'required|min:8|numeric|unique:users',
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
            }else if($errors->has('no_hp')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_hp'),
                ]);
            }else if($errors->has('email')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }else if($errors->has('password')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            }
        }
        $employee = new User;
        $employee->name = Str::title($request->name);
        $employee->alamat = $request->alamat;
        $employee->email = $request->email;
        $employee->role = "admin";
        $employee->no_hp = $request->no_hp;
        $employee->password = Hash::make($request->password);
        $employee->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Karyawan '. $request->name . ' Tersimpan',
        ]);   
    }

    public function show(User $employee)
    {
        //
    }

    public function edit(User $employee)
    {
        return view('pages.office.employee.modal',compact('employee'));

    }

    public function update(Request $request, User $employee)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'alamat' => 'required',
            'email' => 'required|unique:users,email,'.$employee->id,
            'no_hp' => 'required|numeric|unique:users,no_hp,'.$employee->id,
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
            }
        }
        $employee->name = Str::title($request->name);
        $employee->alamat = $request->alamat;
        $employee->email = $request->email;
        $employee->no_hp = $request->no_hp;
        $employee->role = "admin";
        $employee->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Karyawan '. $request->name . ' Diubah',
        ]);   
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Karyawan '. $employee->name . ' Dihapus',
        ]);
    }
}
