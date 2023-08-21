<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Accountholders;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editprofile($id)
    {
        $user_id = decrypt($id);
        $user = DB::table('account_holders')->select('account_holders.*','users.name','users.email')->join('users','users.id','=','account_holders.user_id')->where('users.id',$user_id)->get()->first();
        return view('profile.edit',[
            'user' => $user,
        ]);
    }

    public function updateprofile(Request $request)
    {
        $accountholder = Accountholders::where('id',$request->user_id)->first();
        $user = User::where('id',$accountholder->user_id)->get()->first();
        if($user->email != $request->email){
            $validator = Validator::make($request->all(),[
                'email' => ['required','email','unique:users,email'],
            ]);

            if(!$validator->fails())
            {
                $accountholder->phone_number = $request->phone_number;
                $accountholder->pancard_number = $request->pancard_number;
                $accountholder->aadhar_number = $request->aadhar_number;
                $accountholder->address = $request->address;
                $accountholder->gender = $request->gender;
                $accountholder->dob = $request->dob;

                if($request->hasFile('image'))
                {
                    $file_name = $request->file('image')->getClientOriginalName();
                    $res = explode('.',$file_name);
                    $uniqueid = Str::uuid()->toString();
                    $fileName = $uniqueid.'.'.$res[1];
                    $request->image->move(public_path('/uploads/image/'), $fileName);
                    $accountholder->photo = $fileName;
                }
                $accountholder->update();

                User::where('id',$accountholder->user_id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                return redirect()->route('profile.edit',encrypt($accountholder->user_id))->withStatus('Profile updated successfully');
            }else{
                return back()->withInput()->withError($validator->messages());
            }
        }else{
            $accountholder->phone_number = $request->phone_number;
            $accountholder->pancard_number = $request->pancard_number;
            $accountholder->aadhar_number = $request->aadhar_number;
            $accountholder->address = $request->address;
            $accountholder->gender = $request->gender;
            $accountholder->dob = $request->dob;
            
            if($request->hasFile('image'))
            {
                $file_name = $request->file('image')->getClientOriginalName();
                $res = explode('.',$file_name);
                $uniqueid = Str::uuid()->toString();
                $fileName = $uniqueid.'.'.$res[1];
                $request->image->move(public_path('/uploads/image/'), $fileName);
                $accountholder->photo = $fileName;
            }
            $accountholder->update();

            User::where('id',$accountholder->user_id)->update([
                'name' => $request->name,
            ]);

            return redirect()->route('profile.edit',encrypt($accountholder->user_id))->withStatus('Profile updated successfully');
        }
    }

    public function updatepassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password' => ['required','min:6','string'],
            'confirm_password' => ['required','string','min:6','same:password'],
        ]);
        if(!$validator->fails())
        {
            user::where('id',$request->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('profile.edit',encrypt($request->id))->withStatus('Password updated successsfully');
        }else{
            return back()->withInput()->withError($validate->messages());
        }
    }

    public function updatesecuritypin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'security_pin' => ['required','min:4'],
            'confirm_security_pin' => ['required','min:4','same:security_pin'],
        ]);
        if(!$validator->fails())
        {
            Accountholders::where('user_id',auth()->user()->id)->update([
                'security_pin' => $request->security_pin,
            ]);
            return redirect()->route('dashboard')->withStatus('Security pin updated successfully');
        }else{
            return back()->withInput()->withError($validator->messages());
        }
    }

    public function updateadminprofile(Request $request)
    {
        $user = User::where('id',$request->id)->get()->first();
        if($user->email != $request->email){
            $validator = Validator::make($request->all(),[
                'email' => ['required','email','unique:users,email'],
            ]);

            if(!$validator->fails())
            {
                

                User::where('id',$request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                return redirect()->route('profile.edit',encrypt($request->user_id))->withStatus('Profile updated successfully');
            }else{
                return back()->withInput()->withError($validator->messages());
            }
        }else{
           

            User::where('id',$request->user_id)->update([
                'name' => $request->name,
            ]);

            return redirect()->route('profile.edit',encrypt($request->user_id))->withStatus('Profile updated successfully');
        }
    }

    public function users()
    {
        $users = DB::table('account_holders')->select('account_holders.*','users.name','users.email')->join('users','users.id','=','account_holders.user_id')->get();
        return view('profile.users',[
            'users' => $users,
        ]);
    }

    public function resetsecuritypin()
    {
        return view('profile.resetsecuritypin');
    }
}
