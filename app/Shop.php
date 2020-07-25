<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $casts = [
        'slide_category' => 'array',
        'logo' => 'array',
        'icon' => 'array'
    ];
    public function shopContact()
    {
        return $this->hasOne('App\ShopContact','shop_id');
    }
    public function application()
    {
        return $this->hasOne('App\Application');
    }
    public function slideshows()
    {
        return $this->hasMany('App\Slideshow', 'shop_id');
    }
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function purchases()
    {
        return $this->hasMany('App\UserPurchase');
    }
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function vouchers()
    {
        return $this->hasMany('App\Voucher');
    }
    public function shopCategory()
    {
        return $this->belongsTo('App\ShopCategory' , 'category_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function userVoucher()
    {
        return $this->hasMany('App\UserVoucher');
    }
    public function brands()
    {
        return $this->hasMany('App\Brand');
    }
    public function specifications()
    {
        return $this->hasMany('App\Specification');
    }
    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }
    public function template()
    {
        return $this->belongsTo('App\Template');
    }
    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function subscribers()
    {
        return $this->hasMany('App\Subscriber');
    }

    public function newsletters()
    {
        return $this->hasMany('App\Newsletter');
    }
    public function faqs()
    {
        return $this->hasMany('App\FAQ');
    }
    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }
    public function compares()
    {
        return $this->hasMany('App\Compare');
    }

    public function stats()
    {
        return $this->hasMany('App\Stat');
    }
    public function carts()
    {
        return $this->hasMany('App\Cart');
    }
    public function donwloadLinkRequests()
    {
        return $this->hasMany('App\ProductDownloadStatus');
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice','shop_id');
    }

    public function items()
    {
        return $this->hasMany('App\SpecificationItem');
    }


}
