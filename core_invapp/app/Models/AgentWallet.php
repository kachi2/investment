<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentWallet extends Model
{
    use HasFactory;


    protected $table = "agent_wallets";
    protected $fillable = [

        'agent_id', 'payments', 'salary_paid', 'salary_pending'
    ];
}
