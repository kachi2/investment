<?php

use Illuminate\Database\Seeder;
use App\Models\Referrals;
class AgentReferral extends Seeder
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
            ['agent_id' => 9, 'user_id' => 3],
            ['agent_id' => 9, 'user_id' => 3],
            ['agent_id' => 9, 'user_id' => 3],
            ['agent_id' => 9, 'user_id' => 3],
            ['agent_id' => 9, 'user_id' => 3],
        ];

        foreach($data as $dat){
            Referrals::create($dat);
        }
    }
}
