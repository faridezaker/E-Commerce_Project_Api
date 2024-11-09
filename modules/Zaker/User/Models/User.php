<?php

namespace Zaker\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//use Spatie\Permission\Traits\HasRoles;
use Zaker\User\Notifications\ResetPasswordRequestNotification;
//use Zaker\User\Notifications\VerifyEmail;
use Zaker\User\Notifications\VerifyEmailNotification;
use function Zaker\User\Helpers\to_valid_mobile_number;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'verify_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendResetPasswordRequestNotification()
    {
        $this->notify(new ResetPasswordRequestNotification());
    }

    public function findForPassport($username)
    {
        return static::where('mobile',$username)->orWhere('email',$username)->first();
    }

    public function setMobileAttribute($value)
    {
        $this->attributes['mobile'] = to_valid_mobile_number($value);
    }
}
