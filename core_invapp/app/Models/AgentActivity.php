<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentActivity extends Model
{
    use HasFactory;

    protected $fillable = [

        'agent_id', 'last_login', 'login_ip', 'browser'
    ];
}
