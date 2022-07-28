<?php

use Illuminate\Database\Seeder;
use App\AgentTask;
class Task extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
            ['agent_id'=>9, 'task_type'=>'referral', 'heading'=>'Referral Bonus hits big', 'content'=>'Refer up to 10 people in 7 days. Always use your agent code to register new investors under your downline account', 'bonus'=>20, 'completion'=> 20],
            ['agent_id'=>9, 'task_type'=>'referral', 'heading'=>'Weekly Referral Task', 'content'=>'Refer 20 people, ensure each of the referred people get their accounts verified', 'bonus'=>30, 'completion'=> 40],
            ['agent_id'=>9, 'task_type'=>'investment', 'heading'=>'Weekly Investment Task', 'content'=>'Grow your downline investment to $20,000 in 14 days', 'bonus'=>20, 'completion'=> 100],
            ['agent_id'=>9, 'task_type'=>'investment', 'heading'=>'Hit up to $10,000 investment across your downlines', 'bonus'=>200, 'completion'=> 20],
            ['agent_id'=>9, 'task_type'=>'investment', 'heading'=>'We notice many of your clients are yet to invest, complete investment for each client to get up to $500 bonus', 'bonus'=>500, 'completion'=> 20],
            ['agent_id'=>9, 'task_type'=>'referral', 'heading'=>'Weekly Referral Task', 'content'=>'Refer up to 10 people in 7 days. Always use your agent code to register new investors under your downline account', 'bonus'=>20, 'completion'=> 20],
        ];
        foreach($data as $dat){
            AgentTask::create($dat);
        }
    }
}
