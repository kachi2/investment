<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\AgentTask;
use App\Models\Referrals;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\Payment;
use App\Models\AgentWallet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\AgentActivity;
use App\Models\Salary;

class AdminController extends Controller
{
    //
    public function index(){
        $date = Carbon::now()->addDays(-14);
        $data['registered_users'] = Agent::latest()->get();
        $data['users'] = Agent::where('created_at', '>', $date)->get();
        $data['task'] = AgentTask::latest()->get();
        $data['agent'] = Agent::where('id', auth('agent')->user()->id)->first();
        $data['referrals'] = Referrals::latest()->get();
        $data['referral'] = Referrals::where('created_at', '>', $date)->get();
        $data['payments'] = Payment::sum('amount');
        $data['paymentx'] = Payment::latest()->get();
        $data['payment'] = Payment::where('created_at', '>', $date)->sum('amount');
        $data['wallet'] = AgentWallet::sum('payments');
        $data['salary'] = Salary::sum('amount');
        $data['salaries'] = Salary::where('is_approved', 0)->get()->sum('amount');
        $data['task'] = AgentTask::latest()->get();
        $data['completed_task'] = AgentTask::where('completion', '=', '100')->where('created_at', '>', $date)->get();
        $data['activity'] = AgentActivity::where('created_at', '>', $date)->latest()->get();
        $data['activities'] = AgentActivity::latest()->take(6)->get();
        return view('agency.admin.index', $data);
    }

    public function Referals(){
        $referals = Referrals::latest()->get();
        $pending = Referrals::where(['status' => 0])->get();
        $new_registered = Referrals::where('created_at','>',Carbon::now()->addDays(-14))->get();
        return view('agency.admin.referrals', compact('referals', $referals, 'pending',$pending, 'new_registered',$new_registered));
        }

    public function Payments(){
        return view('agency.admin.payments')
        ->with('payments', Payment::latest()->paginate(20));
    }

    public function Salaries(){
        $payments = Salary::latest()->get();
        return view('agency.admin.salaries', compact('payments', $payments));
    }
    public function Invoices($id){
        $salary = Salary::where('id', decrypt($id))->first();
        return view('agency.admin.invoice', compact('salary', $salary));
    }

    public function InvoicesApprove($id){
        $salary = Salary::where('id', decrypt($id))->first();
        $salary->update(['is_approved' => 1]);
        Session::flash('alert', 'success');
        Session::flash('msg', 'Invoice Approved Successfully');
        return view('agency.admin.invoice', compact('salary', $salary));
    }

    public function InvoicesCancel($id){
        $salary = Salary::where('id', decrypt($id))->first();
        $salary->update(['is_approved' => 2]);
        Session::flash('alert', 'error');
        Session::flash('msg', 'Invoice Cancel Successfully');
        return view('agency.admin.invoice', compact('salary', $salary));
    }

    public function AgentList(){
        return view('agency.admin.agents')
        ->with('agents', Agent::latest()->simplePaginate(20));
    }

    public function AgentDetails($id){
        $agent = Agent::where('id', decrypt($id))->first();
        return view('agency.admin.details', compact('agent', $agent));
    }

    public function changePass(Request $request, $id){

        $valid = validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);
        if($valid->fails()){

            Session::flash('alert', 'error');
            Session::flash('msg', $valid->errors()->first());
            return back();
        }

        $agent = Agent::where('id', decrypt($id))->first();
        //check old password 
            $pwd = bcrypt($request->password);
            $agent->update( array( 'password' =>  $pwd));
            Session::flash('alert', 'success');
            Session::flash('msg', 'Password Updated Successfully');
            return back();
    }

}
