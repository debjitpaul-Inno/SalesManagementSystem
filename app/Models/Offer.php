<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Offer extends Model
{
    use HasFactory, SoftDeletes;
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
//    public function paymentTypes()
//    {
//        return $this->belongsTo(PaymentType::class,'user_id','id');
//    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_offers',
            'offer_id','product_id')->withPivot("product_id", "offer_id", "start_date","end_date")->withTimestamps();

    }
}
