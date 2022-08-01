<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agent;
use App\Models\AgentActivity;
use App\Models\Payment;
use App\Models\Referrals;
use App\Models\AgentTask;
use Illuminate\Support\Facades\Session;
use App\Models\AgentWallet;
use Illuminate\Support\Facades\Validator;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

        //
        public function __construct()
        {
           
        return $this->middleware('agent');
           
        }
        public function Index(){
            $date = Carbon::now()->addDays(-14);
            $data['agent'] = Agent::where('id', auth('agent')->user()->id)->first();
            $data['referrals'] = Referrals::where('agent_id', agent_user()->id)->get();
            $data['referral'] = Referrals::where('agent_id', agent_user()->id)->where('created_at', '>', $date)->get();
            $data['payments'] = Payment::where('agent_id', agent_user()->id)->latest()->get();
            $data['payment'] = Payment::where('agent_id', agent_user()->id)->where('created_at', '>', $date)->get();
            $data['wallet'] = AgentWallet::where('agent_id', agent_user()->id)->first();
            $data['task'] = AgentTask::where('agent_id', agent_user()->id)->latest()->get();
            $data['completed_task'] = AgentTask::where(['agent_id' => agent_user()->id])->where('completion', '=', '100')->where('created_at', '>', $date)->get();
            $data['activity'] = AgentActivity::where('agent_id', agent_user()->id)->where('created_at', '>', $date)->latest()->get();
            $data['activities'] = AgentActivity::where('agent_id', agent_user()->id)->latest()->take(6)->get();
            $data['next_salary'] = Salary::where('agent_id', agent_user()->id)->latest()->first();
           
            return view('agency.home', $data);
        }
    
        public function Task(){
            return view('agency.task')
            ->with('tasks', AgentTask::where('agent_id', agent_user()->id)->get());
        }
    
        public function Payments(){
            return view('agency.payments')
            ->with('payments', Payment::where('agent_id', agent_user()->id)->latest()->get());
        }
    
        public function SalaryPayments(){
            return view('agency.salary')
            ->with('payments', Salary::where('agent_id', agent_user()->id)->get());
        }
    
        public function SalaryInvoice(Request $request){
    
            $valid = Validator::make($request->all(), [
                'amount' => 'required',
                'payment_method' => 'required',
                'wallet_address' => 'required'
            ]);
            if($valid->fails()){
                Session::flash('alert', 'error');
                Session::flash('msg', $valid->errors()->first());
                return back();
            }
    
            if($request->amount < 500){
                Session::flash('alert', 'error');
                Session::flash('msg', "Amount should not be less than $500");
                return back();
            }
    
            $agentWallet = agent_user()->wallets->payments;
            if($agentWallet < $request->amount){
                Session::flash('alert', 'error');
                Session::flash('msg', "Amount is greater than your Available Balance");
                return back();
            }
            $payment = Salary::where('agent_id', agent_user()->id)->latest()->first();
            $now = Carbon::now();
            if($payment == null){
                $payment = $now->addDays(14);
            }else{
              
                $payment = $payment->next_pay;
            }

          
            if($payment > $now){
            
                Session::flash('alert', 'error');
                Session::flash('msg', "Your next payment is on ". Date("M,d", strtotime($payment)));
                return back();
            }
    
            #======deduct agent fund ========
           $wallet = AgentWallet::where('agent_id', agent_user()->id)->first();
    
           $addToPending = $wallet->salary_pending + $request->amount;
           $removeWallet = $wallet->payments - $request->amount;
           $wallet->update([
            'salary_pending' => $addToPending,
            'payments' => $removeWallet
           ]);
    
            $ref = generate_reference();
            $salary = new Salary;
            $salary->ref = $ref;
            $salary->agent_id = agent_user()->id;
            $salary->amount = $request->amount;
            $salary->total = $request->amount - ($request->amount * 0.075);
            $salary->payment_method = $request->payment_method;
            $salary->wallet_address = $request->wallet_address;
            $salary->prev_balance = $wallet->payments;
            $salary->avail_balance = $removeWallet;
            $salary->is_approved = 0;
            $salary->next_pay = Carbon::now()->addDays(14);
    
            if($salary->save()){
                Session::flash('alert', 'success');
                Session::flash('msg', 'Invoice Generated Successfully');
                return redirect()->back();
            }
    
        }
    
        public function SalaryInvoices($id){
            $salary = Salary::where('id', decrypt($id))->first();
            return view('agency.invoice', compact('salary', $salary));
        }
    
        public function paymentProcessor(){
            $ref = generate_reference();
            $payment = new Payment;
            $payment->agent_id = agent_user()->id;
            $payment->amount = 20;
            $payment->ref = $ref;
            $payment->status = 'success';
            if($payment->save()){
            $wallet = AgentWallet::where('agent_id', agent_user()->id)->first();
            $wallet->update(['payments' => $wallet->payments + 20]);
            Session::flash('alert', 'success');
            Session::flash('msg', 'Payment Proccessed Successfully');
            return redirect()->back();
            }
        }

public function Account(){
    return view('agency.accounts');
}


    public function UpdateAccount(Request $request){

        $user = Agent::where('id', agent_user()->id)->first();
        if($request->name){
            $data['name'] = $request->name;
        }
        if($request->name){
            $data['city'] = $request->city;
        }
        if($request->name){
            $data['state'] = $request->state;
        }
        if($request->name){
            $data['country'] = $request->country;
        }
        if($request->name){
            $data['payment_method'] = $request->payment_method;
        }
        if($request->name){
            $data['wallet_address'] = $request->wallet_address;
        }
        if($request->image){
            $image = request()->file('image');
            $ext = $image->getClientOriginalExtension();
            $file = md5(time()).'.'.$ext;
            $image->move('images', $file);
            $data['img'] = $file;
        }
      $update = $user->update($data);
      if($update){
        Session::flash('alert', 'success');
        Session::flash('msg', 'Account information updated successfully');
        return redirect()->back();
      }

    }


    public function UpdatePassword(Request $request){

        $valid = validator::make($request->all(), [

            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        if($valid->fails()){

            Session::flash('alert', 'error');
            Session::flash('msg', $valid->errors()->first());
            return back();
        }

        $agent = Agent::where('id', agent_user()->id)->first();
        //check old password 
        if(Hash::check($request->old_password,$agent->password)){
            $pwd = bcrypt($request->password);
            $agent->update( array( 'password' =>  $pwd));
            Session::flash('alert', 'success');
            Session::flash('msg', 'Password Updated Successfully');
            return back();
        }else{
            Session::flash('alert', 'error');
            Session::flash('msg', 'Old Password is not correct');
            return back();

        }
    }
public function logout(Request $request){
    Auth::guard('agent')->logout();
    $request->session()->flush();    
    return redirect()->route('Agent-login');            
        } 
}
