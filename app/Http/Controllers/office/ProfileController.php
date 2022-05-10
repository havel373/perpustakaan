<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = User::where('id',Auth::user()->id)->first();
        return view('pages.office.profile.main',compact('profile'));
    }

    public function update(){
        
    }

}
