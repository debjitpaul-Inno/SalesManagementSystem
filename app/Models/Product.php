<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes, SoftCascadeTrait;
    protected $guarded = [
        'id',
        'uuid'
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid =$uuid;
        });
    }

    public function subCategories()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function racks()
    {
        return $this->belongsToMany(Rack::class,'product_racks',
            'product_id','rack_id')->withPivot("product_id", "rack_id")->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_orders');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'product_offers');
    }

//    public function ReturnOrders()
//    {
//        return $this->belongsToMany(Order::class, 'product_returns');
//
//    }

    public function stores(){
        return $this->hasOne(Store::class, 'product_id','id');
    }

    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function stockIns()
    {
        return $this->belongsToMany(StockIn::class, 'product_stock_ins');
    }

    public function productReturns()
    {
        return $this->hasMany(ProductReturn::class, 'id', 'product_id');
    }

    public function damages()
    {
        return $this->belongsToMany(Damage::class, 'product_damages');
    }
}
