<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentTask extends Model
{
    use HasFactory;

    protected $fillable = [
       'agent_id','task_type','heading','expires','content','bonus','completion', 'referrals'
    ];

    public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }
}
