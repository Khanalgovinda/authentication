<?php

namespace App\Http\Controllers;


use App\Models\Form;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
      

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route("logins");
    }

    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        if(!is_null($user))
        {
            
            if(Hash::check($request->password,$user->password))
            {
                Auth::login($user,true);
                return redirect()->route("homes");
            }
            
        }

        return redirect()->route("logins");
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('logins');
    }

}