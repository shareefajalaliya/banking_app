<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function userlogin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => ['required','exists:users,email','email'],
            'password' => ['required','min:6','string'],
        ]);
        if(!$validator->fails())
        {
            $credentials = $request->only('email','password');
            if(Auth::attempt($credentials))
            {
                $user = User::where('email',$request->email)->get()->first();
                if($user)
                {
                    if(Hash::check($request->password,$user->password))
                    {
                        Auth::login($user,$request->get('rememberme'));
                        return redirect()->route('dashboard');
                    }else{
                        return redirect()->route('login')->withError('Incorrect password');
                    }
                }else{
                    return redirect()->route('login')->withError('User not found');
                }
            }
        }
        else
        {
            return back()->withInput()->withError($validator->messages());
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
