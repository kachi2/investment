<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salary;
class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['agent_id' => 9, 'amount' => 3000, 'payment_method' => 'ETH', 'wallet_address' => 'EWRERGTGGUJHJIUYUFYUFUUYU', 'is_approved'  => 1],
            ['agent_id' => 9, 'amount' => 6000, 'payment_method' => 'BTC', 'wallet_address' => 'BYGHEWRERGTGGUJHJIUYUFYUFUUYU', 'is_approved'  => 0],
            ['agent_id' => 9, 'amount' => 4000, 'payment_method' => 'BTC', 'wallet_address' => 'BYGEWRERGTGGUJHJIUYUFYUFUUYU', 'is_approved'  => 1],
            ['agent_id' => 9, 'amount' => 34000, 'payment_method' => 'LTC', 'wallet_address' => 'KQWEWRERGTGGUJHJIUYUFYUFUUYU', 'is_approved'  => 0],
        ];

        foreach($data as $dat){
            Salary::create($dat);
        }
    }
}
