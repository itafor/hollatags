<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mobile_number','amount_to_bill','email' 'password', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      public static function updateUserDetailAfterBill($data)
    {
     $bill  =  self::where([
            ['username', $data['username'] ],
            ['mobile_number', $data['mobile_number'] ],
        ])->update([
            'amount_to_bill' => $data['amount_to_bill'],
        ]); 

        // return $bill;
    }
}
