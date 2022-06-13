<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
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

            $today = date("Ymd");
            $rand = strtoupper(substr(uniqid(sha1(time())),0,2));
            $unique = $today . $rand;
            $model->order_number = $unique;
        });
    }

    protected $casts= [
        'description' => 'array'
    ];


    public function customers()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_orders',
            'order_id','product_id')->withPivot("product_id", "order_id", "quantity")->withTimestamps();

    }

    public function productReturns()
    {
        return $this->hasMany(ProductReturn::class, 'id', 'order_id');
    }

}
