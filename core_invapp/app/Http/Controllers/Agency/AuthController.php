<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Mail\AgentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Agent;
use App\Models\AgentActivity;
use App\Models\AgentTask;
use App\Models\AgentWallet;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //
    public function register(){
        return view('agency.register');
    }

    public function registers(Request $req){
    $valid = Validator::make($req->all(), [
        'name' => 'required',
        'email' => 'required|unique:agents',
        'phone' => 'required|unique:agents',
    ]);
        if($valid->fails()){
            return redirect()->back()->withInput($req->all())->withErrors($valid);
        }
       
        $agent = new Agent;
        $agent->name = $req->name;
        $agent->email = $req->email;
        $agent->phone = $req->phone;
        $agent->working_hours = 4;
        $agent->pay_day = 14;

        if($agent->save()){
            sleep(4);
        $agents = Agent::latest()->first();
            $data = [
                'name' => $req->name,
                'email' => $req->email,
                'phone' => $req->phone,
                'id' => $agents->id
            ];
        
        mail::to($req->email)->send(new AgentRegistration($data));
        Session::flash('alert', 'success');
        Session::flash('msg', 'Agent Created Successully');
        return redirect()->back();
        }
    }

    public function CompleteRegistration($id){
        $agent = Agent::where('id', decrypt($id))->first();
        return view('agency.completeRegistration', compact('agent', $agent));
    }

    public function AccountCompleted(Request $req, $id){

        $valid = Validator::make($req->all(), [
                'password' => 'required|min:8|confirmed',
                'address' => 'required',
                'image' => 'required',
                'state' => 'required',
                'country' => 'required',
        ]);
        if($valid->fails()){
            return redirect()->back()->withInput($req->all())->withErrors($valid);
        }
        if($req->file('image')){
            $image = request()->file('image');
            $file = $image->getClientOriginalName();
            $fileName = \pathinfo($file, PATHINFO_FILENAME);
            $ext = $image->getClientOriginalExtension();
            $filename = $fileName.'.'. $ext;
            $image->move('agency/images/', $filename);
        }

        $agent = Agent::where('id', decrypt($id))->first();
        $update = Agent::where('id', $agent->id)
            ->update([

                'password' => hash::make($req->password),
                'city' => $req->address,
                'doc' => $filename ,
                'is_accepted' => 1,
                'city' => $req->address,
                'state' => $req->state,
                'country' => $req->country,
            ]);
        if($update){
        $agentWalet = AgentWallet::where('agent_id', $agent->id)->first();
        if(!$agentWalet){

            AgentWallet::create([
                'agent_id' => $agent->id,
                'payments' => 0,
                'salary_paid' => 0,
                'salary_pending' => 0,
            ]);
        }
       
        AgentActivity::create([
            'agent_id' => $agent->id,
            'last_login' => Carbon::now()->toDateTimeString(),
            'browser' => $req->userAgent(),
            'login_ip' => $req->Ip(),
        ]);
        AgentTask::create([
            'agent_id' => $agent->id,
            'task_type' => 'referral',
            'heading' => 'Welcome Task',
            'content' => 'Its time to prove you are good for this job, share your referral link on your profile to your friends and get 10 new users in 7 days',
            'expires' => Carbon::now()->addDays(7),
            'bonus' => '$20',
            'completion' => 0
        ]);
        Auth::loginUsingId($agent->id);
        Session::flash('alert', 'success');
        Session::flash('msg', 'Account Setup Completed');
        return redirect()->route('agency.index');
        }
    }

    public function Login(){
        return view('agency.login');
    }

    public function Logins(Request $req){
        $valid = Validator::make($req->all(), [
            'password' => 'required',
            'email' => 'required'
    ]);
    if($valid->fails()){
        return redirect()->back()->withInput($req->all())->withErrors($valid);
    }
    $credentials = $req->only('email', 'password');

  
    if(Auth::guard('agent')->attempt($credentials)){
        agent_user()->update([
            'last_login' => Carbon::now()->toDateTimeString(),
            'login_ip'  => $req->getClientIp(),
            'login_counts' => agent_user()->login_counts + 1
        ]);
        AgentActivity::create([
            'agent_id' => agent_user()->id,
            'last_login' => Carbon::now()->toDateTimeString(),
            'browser' => $req->userAgent(),
            'login_ip' => $req->Ip(),
        ]);
        //dd(auth::guard('agent'));
   //dd(auth('agent')->user()->id);
        return redirect()->route('agency.index');
    }else{
        return redirect()->back()->withInput($req->all())->withErrors($valid);
    }

}

    public function logout(){
        auth()->guard('agent')->logout();
        Session::flush();
        return view('agency.login');
    }
}
