<?php

namespace App\Http\Controllers\Office;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax() ){
            $keywords = $request->keywords;
            $collection = User::where('role','member')->where(function($query) use ($keywords){
                $query->where('name','like','%'.$keywords.'%');
                $query->orWhere('email','like','%'.$keywords.'%');
                $query->orWhere('no_hp','like','%'.$keywords.'%');
            })->orderBy('created_at','desc')->paginate(5);
            return view('pages.office.member.list',compact('collection'));
        }
        return view('pages.office.member.main');
    }

    public function create(User $member)
    {
       return view('pages.office.member.modal',["user"=> new User, "member"=> $member]);
    }

    
    public function store(Request $request, User $member)
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
        $member = new User;
        $member->name = Str::title($request->name);
        $member->alamat = $request->alamat;
        $member->email = $request->email;
        $member->no_hp = $request->no_hp;
        $member->password = Hash::make($request->password);
        $member->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Member '. $request->name . ' Tersimpan',
        ]);   
    }
    public function edit(User $member)
    {
        return view('pages.office.member.modal',compact('member'));
    }

    public function update(User $member, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'alamat' => 'required',
            'email' => 'required|unique:users,email,'.$member->id,
            'no_hp' => 'required|numeric|unique:users,no_hp,'.$member->id,
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
            }
        }
        $member->name = Str::title($request->name);
        $member->alamat = $request->alamat;
        $member->email = $request->email;
        $member->no_hp = $request->no_hp;
        $member->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Member '. $request->name . ' Diubah',
        ]);   
    }
    
    public function destroy(User $member)
    {
        $member->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Member '. $member->name . ' Dihapus',
        ]);
    }
}
