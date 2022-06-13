<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class StockIn extends Model
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

    protected $casts= [
        'description' => 'array'
    ];

    public function vendors()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_stock_ins',
            'stock_in_id','product_id')->withPivot("product_id", "stock_in_id", "quantity","amount","unit_price")->withTimestamps();
    }
}
