<?php

namespace App\Models;

use App\Enums\UserRoles;
use App\Enums\UserStatus;
use App\Enums\TransactionType;
use App\Enums\InvestmentStatus;
use App\Enums\TransactionStatus;
use App\Filters\Filterable;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use Notifiable, Filterable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'status',
        'refer',
        '2fa',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'last_login' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @version 1.0.0
     * @since 1.0
     */
    public function verify_token()
    {
        return $this->hasOne(VerifyToken::class, 'email', 'email')->where('user_id', $this->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function user_metas()
    {
        return $this->hasMany(UserMeta::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function refer_codes()
    {
        return $this->hasMany(ReferralCode::class);
    }

    /**
     * @return mixed
     * @version 1.0.0
     * @since 1.0
     */
    public function meta($key=null)
    {
        $userMetas = $this->user_metas()->pluck('meta_value', 'meta_key');

        if(!empty($key)) {
            return (Arr::get($userMetas, $key)) ? Arr::get($userMetas, $key) : false;
        }

        return $userMetas->toArray();
    }

    /**
     * @return array|\ArrayAccess|mixed
     * @version 1.0.0
     * @since 1.0
     */
    public function getDisplayNameAttribute()
    {
        $userMetas = $this->user_metas()->pluck('meta_value', 'meta_key');
        return (Arr::get($userMetas, 'profile_display_full_name') == 'on') ? $this->name : Arr::get($userMetas, 'profile_display_name');
    }

    /**
     * @return array|\ArrayAccess|mixed
     * @version 1.0.0
     * @since 1.0
     */
    public function getAvatarBgAttribute()
    {
        $userMetas = $this->user_metas()->pluck('meta_value', 'meta_key');
        return (Arr::get($userMetas, 'profile_avatar_bg')) ? Arr::get($userMetas, 'profile_avatar_bg') : 'primary';
    }

    public function getReferrerAttribute()
    {
        return self::where('id', $this->refer)->first();
    }

    /**
     * @return array|\ArrayAccess|mixed
     * @version 1.0.0
     * @since 1.0
     */
    public function getReferralCodeAttribute()
    {
        $userMetas = $this->refer_codes->pluck('meta_value', 'meta_key');
        return (Arr::get($userMetas, 'profile_avatar_bg')) ? Arr::get($userMetas, 'profile_avatar_bg') : 'primary';
    }

    /**
     * @return boolean
     * @version 1.0.0
     * @since 1.0
     */
    public function getIsVerifiedAttribute()
    {
        return (empty($this->meta('email_verified'))) ? false : true;
    }

    /**
     * @return boolean
     * @version 1.0.0
     * @since 1.0
     */
    public function getHasBasicAttribute()
    {
        return ($this->meta('profile_phone') && $this->meta('profile_dob') && $this->meta('profile_display_name') && $this->meta('profile_country')) ? true : false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function withdraw_method_details()
    {
        return $this->hasMany(UserAccount::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class)
            ->where('status', 'completed')
            ->orderBy('completed_at', 'desc')
            ->limit(20);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function miscTnx()
    {
        return $this->hasMany(Transaction::class)
            ->whereIn('status', [
                TransactionStatus::CONFIRMED,
                TransactionStatus::ONHOLD,
                TransactionStatus::PENDING,
                TransactionStatus::CANCELLED,
                TransactionStatus::FAILED
            ])
            ->orderBy('id','desc')
            ->limit(20);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function invested()
    {
        return $this->hasMany(IvInvest::class)->whereIn('status', [InvestmentStatus::ACTIVE, InvestmentStatus::COMPLETED]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function activities()
    {
        return $this->hasMany(UserActivity::class)->orderBy('id', 'desc')->limit(20);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function accounts()
    {
        return $this->hasMany(UserAccount::class);
    }

    /**
     * @return mixed|number
     * @version 1.0.0
     * @since 1.0
     */
    public function balance_locked($fund)
    {
        $funds = 0;

        if($fund==TransactionType::DEPOSIT) {
            $funds = $this->hasMany(Transaction::class)->where('type', $fund)->whereIn('status', [TransactionStatus::PENDING, TransactionStatus::ONHOLD]);
        }
        if($fund==TransactionType::WITHDRAW) {
            $funds = $this->hasMany(Transaction::class)->where('type', $fund)->whereIn('status', [TransactionStatus::PENDING, TransactionStatus::CONFIRMED, TransactionStatus::ONHOLD]);
        }

        return (!empty($funds)) ? $funds->sum('amount') : 0;
    }

    /**
     * @return mixed |number
     * @version 1.0.0
     * @since 1.0
     */
    public function tnx_amounts($type_of, $calc='total')
    {
        switch ($type_of) {
            case 'bonus':
                $type = TransactionType::BONUS;
                break;
            case 'charge':
                $type = TransactionType::CHARGE;
                break;
            case 'deposit':
                $type = TransactionType::DEPOSIT;
                break;
            case 'withdraw':
                $type = TransactionType::WITHDRAW;
                break;
            case 'investment':
                $type = TransactionType::INVESTMENT;
            default:
                $type = false;
        }

        if($type) {
            $getTnx = $this->hasMany(Transaction::class)->where('type', $type)->whereIn('status', [TransactionStatus::COMPLETED]);

            if(blank($getTnx)) return 0;

            if($calc=='month') {
                return $getTnx->whereBetween( 'completed_at', [ Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()] )->sum('amount');
            }

            return $getTnx->sum('amount');
        }

        return 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function balance($name=null)
    {
        $account = (empty($name)) ? AccType('main') : $name;
        if(in_array($name, ['locked_amount', 'active_invest'])) {
            if ($name == 'active_invest') {
                return $this->invested()->where('status', InvestmentStatus::ACTIVE)->sum('amount');
            } elseif ($name == 'locked_amount') {
                return $this->balance_locked(TransactionType::DEPOSIT) + $this->balance_locked(TransactionType::WITHDRAW);
            }
            return 0;
        } else {
            $balances = $this->balances()->pluck('amount', 'balance');

            if(!empty($account)) {
                return (Arr::get($balances, $account)) ? Arr::get($balances, $account) : 0;
            }
            return $balances->toArray();
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @version 1.0.0
     * @since 1.0
     */
    public function balances()
    {
        return $this->hasMany(Account::class);
    }

    public function getShortcutDetailsAttribute()
    {
        $data = [
            __("Full Name") => $this->name,
            __("Email") => $this->email, 
            __('User ID') => the_uid($this->id),
        ];
        return collect($data);
    }

    public function scopeWithoutSuperAdmin($query)
    {
        return $query->where('role', '<>', UserRoles::SUPER_ADMIN);
    }

    public function getHasValidReferrerAttribute()
    {
        if(empty($this->referrer)) return false;
        
        return ($this->referrer->is_verified && $this->referrer->status === UserStatus::ACTIVE) ? true : false;
    }
}
