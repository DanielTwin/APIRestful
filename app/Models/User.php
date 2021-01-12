<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Transformers\UserTransformer;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const VERIFIED_USER = '1';
    const USER_NOT_VERIFIED = '0';

    const USER_ADMINISTATOR = 'true';
    const USER_REGULAR = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    public $transformer = UserTransformer::class;
    protected $dates = ['deleted_at'];

  

    protected $fillable = [
        
        'name',
        'email',
        'email_verified_at',
        'password',
        'verified',
        'verification_token',
        'admin',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
        'password',
        'remember_token',
        'verification_token',

    ];

    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdministator()
    {
        return $this->admin == User::USER_ADMINISTATOR;
    }

    public static function generateVerificationToken()
    {
        return Str::random(40);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
