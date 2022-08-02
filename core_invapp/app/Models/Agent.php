<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent extends Authenticatable
{
    use HasFactory, Notifiable;
        //
    
        protected $hidden = [
            'password', 'remember_token',
        ];
        use Notifiable;
    
        protected $guard = "agent";
    
        protected $fillable = [
            'name', 'email', 'password', 'phone', 'city', 'state', 'country', 'working_hours', 'pay_day', 'email_verify', 'last_login', 'login_ip', 'is_accepted', 'doc', 'login_counts', 'address', 'wallet_address', 'payment_method', 'ref_code', 'img'
        ];
    
        protected $table = "agents";
    
        public function wallets(){
            return $this->hasOne(AgentWallet::class, 'agent_id', 'id');
        }
        public function Ref(){
            return $this->hasMany(Referrals::class);
        }
        public function referred(){
            return $this->hasMany(Referrals::class);
        }

        
    }
    