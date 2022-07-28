<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgentWallet;
class WalletAgent extends Seeder
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
            ['agent_id' => 9, 'payments' => 3000, 'salary_paid' => 2000, 'salary_pending' => 1000],
        ];

        foreach($data as $dat){
            AgentWallet::create($dat);
        }
}
}
