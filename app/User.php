<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use  Notifiable;

    protected $dates = ['deleted_at'];
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'status', 'is_superAdmin'
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


    public function wishlist()
    {
        return $this->hasOne('App\Wishlist');
    }
    public function compare()
    {
        return $this->hasOne('App\Compare');
    }


    public function shop()
    {
        return $this->hasOne('App\Shop');
    }

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }

    public function checkouts()
    {
        return $this->hasMany('App\Checkout');
    }
    public function purchases()
    {
        return $this->hasMany('App\UserPurchase');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }




}
