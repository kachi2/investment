<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{
    use HasFactory;


    protected $table = "agent_referrals";

    protected $fillables = [
        'agent_id', 'user_id',
    ];
}
