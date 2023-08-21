<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Accountholders;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function deposit()
    {
        return view('transactions.deposit');
    }

    public function amountdeposit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'amount' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/'],
            'security_pin' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/'],
        ]);
        if(!$validator->fails())
        {
            $details = Accountholders::select('security_pin','balance','id')->where('user_id',auth()->user()->id)->get()->first();
            if($details->security_pin == $request->security_pin)
            {
                $bank_balance = $details->balance;
                $balance = $bank_balance + $request->amount;
                Accountholders::where('user_id',auth()->user()->id)->update([
                    'balance' => $balance,
                ]);

                DB::table('statements')->insert([
                    'user_id' => $details->id,
                    'transfer_id' => $details->id,
                    'amount' => $request->amount,
                    'type' => 'Credit',
                    'details' => 'Deposit',
                    'transaction_date' => date('Y-m-d H:i:s'),
                    'balance' => $balance,
                ]);

                return redirect()->route('deposit')->withStatus('Amount deposited successfully');
            }else{
                return redirect()->route('deposit')->withError('Invalid Security Pin');
            }
        }else{
            return back()->withInput()->withErrors($validator->messages());
        }
    }

    public function withdraw()
    {
        return view('transactions.withdraw');
    }

    public function amountwithdraw(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'amount' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/'],
            'security_pin' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/'],
        ]);
        if(!$validator->fails())
        {
            $details = Accountholders::select('id','balance','security_pin')->where('user_id',auth()->user()->id)->get()->first();
            if($request->amount < $details->balance)
            {
                if($request->security_pin == $details->security_pin)
                {
                    $balance = $details->balance - $request->amount;
                    Accountholders::where('id',$details->id)->update([
                        'balance' => $balance,
                    ]);

                    DB::table('statements')->insert([
                        'user_id' => $details->id,
                        'transfer_id' => $details->id,
                        'amount' => $request->amount,
                        'type' => 'Debit',
                        'details' => 'Withdraw',
                        'transaction_date' => date('Y-m-d H:i:s'),
                        'balance' => $balance,
                    ]);

                    return redirect()->route('withdraw')->withStatus('Amount withdraw successfully');
                }else{
                    return redirect()->route('withdraw')->withError('Invalid security pin');
                }
            }else{
                return redirect()->route('withdraw')->withError('Invalid Amount');
            }
        }else{
            return back()->withInput()->withError($validate->messages());
        }    
    }

    public function transfer()
    {
        return view('transactions.transfer');
    }

    public function amounttransfer(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => ['required','email','exists:users,email'],
            'amount' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/'],
            'security_pin' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/'],
        ]);
        if(!$validator->fails())
        {
            $user_email =  DB::table('users')->select('email')->where('id',auth()->user()->id)->get()->first(); 
            $user_id = DB::table('users')->select('id','email')->where('email',$request->email)->get()->first();
            $details = Accountholders::select('id','balance','security_pin')->where('user_id',auth()->user()->id)->get()->first();
            if($request->amount < $details->balance)
            {
                if($request->security_pin == $details->security_pin)
                {
                    $transfer_user = Accountholders::select('id','balance')->where('user_id',$user_id->id)->get()->first();
                    $balance = $details->balance - $request->amount;
                    Accountholders::where('id',$details->id)->update([
                        'balance' => $balance,
                    ]);
                    $transfer_amount = $transfer_user->balance + $request->amount;

                    Accountholders::where('id',$transfer_user->id)->update([
                        'balance' => $transfer_amount,
                    ]);

                    DB::table('statements')->insert([
                        'user_id' => $details->id,
                        'transfer_id' => $transfer_user->id,
                        'amount' => $request->amount,
                        'type' => 'Debit',
                        'details' => 'Transfer to '.$user_id->email,
                        'transaction_date' => date('Y-m-d H:i:s'),
                        'balance' => $balance,
                    ]);

                    DB::table('statements')->insert([
                        'user_id' => $transfer_user->id,
                        'transfer_id' => $details->id,
                        'amount' => $request->amount,
                        'type' => 'Credit',
                        'details' => 'Transfer from '.$user_email->email,
                        'transaction_date' => date('Y-m-d H:i:s'),
                        'balance' => $transfer_amount,
                    ]);

                    return redirect()->route('transfer')->withStatus('Amount withdraw successfully');
                }else{
                    return redirect()->route('transfer')->withError('Invalid security pin');
                }
            }else{
                return redirect()->route('transfer')->withError('Invalid Amount');
            }
        }else{
            return back()->withInput()->withError($validator->messages());
        }
    }

    public function statements()
    {
        $users = 0;
        if(auth()->user()->role == 1){
            $acc_id = Accountholders::select('id')->where('user_id',auth()->user()->id)->get()->first();
            if($_GET == null){
                $statements = DB::table('statements')->where('user_id',$acc_id->id)->orderBy('id','DESC')->get();

            }

            if(isset($_GET['start_date']))
            {
                $statements = DB::table('statements')->where('user_id',$acc_id->id)->whereDate('transaction_date','>=',$_GET['start_date'])->orderBy('id','DESC')->get();

            }

            if(isset($_GET['end_date']))
            {
                $statements = DB::table('statements')->where('user_id',$acc_id->id)->whereDate('transaction_date','<=',$_GET['end_date'])->orderBy('id','DESC')->get();

            }
            if(isset($_GET['start_date']) && isset($_GET['end_date']))
            {
                $statements = DB::table('statements')->where('user_id',$acc_id->id)
                ->whereDate('transaction_date','>=',$_GET['start_date'])
                ->whereDate('transaction_date','<=',$_GET['end_date'])
                ->orderBy('id','DESC')->get();
            }
        }
        if(auth()->user()->role == 0)
        {
            
            $statements = DB::table('statements')->orderBy('id','DESC')->get();

            
            


        }
        return view('transactions.statements',[
            'statements' => $statements,
            'users' => $users,
        ]);
    }
}
