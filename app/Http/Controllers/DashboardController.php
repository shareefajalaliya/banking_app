<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $total_users = 0;
        if(auth()->user()->role == 1){

            $user = DB::table('account_holders')->select('account_holders.*','users.name','users.email')->join('users','users.id','=','account_holders.user_id')->where('users.id',auth()->user()->id)->get()->first();
        }
        if(auth()->user()->role == 0)
        {
            $user = DB::table('users')->where('id',auth()->user()->id)->get()->first();
            $total_users = count(DB::table('account_holders')->get());
        }
        return view('dashboard.index',[
            'user' => $user,
            'total_users' => $total_users,
        ]);
    }
}
