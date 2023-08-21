<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Accountholders;
use App\Models\User;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','min:4'],
            'email' => ['required','email','unique:users,email'],
            'phone_number' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','string','min:10'],
            'pancard_number' => ['required','string'],
            'aadhar_number' => ['required','string'],
            'password' => ['required','min:6','string'],
            'confirm_password' => ['required','string','min:6','same:password'],
        ]);
        if(!$validator->fails())
        {
            $account_number = random_int(10000000000000,99999999999999);
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 1;
            $user->active = 1;
            $user->save();

            $accountholder = new Accountholders;
            $accountholder->phone_number = $request->phone_number;
            $accountholder->pancard_number = $request->pancard_number;
            $accountholder->aadhar_number = $request->aadhar_number;
            $accountholder->account_number = $account_number;
            $accountholder->user_id = $user->id;
            $accountholder->active = 1;
            $accountholder->save();

            return redirect()->route('login')->withStatus('User created successfully');

        }else{
            return back()->withInput()->withError($validator->messages());
        }
    }
}
