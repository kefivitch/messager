<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'string|max:191',
            'email' => 'email|max:191',
        ]);
        $user = User::find($request->user_id);
        //return $user;
        if($request->name) {
            $user->name = $request->name;
        }
        if ($request->email) {
            $user->email = $request->email;
        }

        $user->save();
        return redirect('/inbox')->with('success', 'Profile updated!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'curPassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = User::find($request->user_id);
        if (Hash::check($request->curPassword,$user->password )) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/inbox')->with('success', 'Password updated!');
            
        }

        return redirect('/inbox')->with('error', 'Please enter your old password !');
        

        
    }
}
