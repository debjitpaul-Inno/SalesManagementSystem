<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory, SoftDeletes, SoftCascadeTrait;
    protected $guarded = [
        'id',
        'uuid'
    ];
    protected $casts = [
        'address' => 'array',
    ];
//    protected $softCascade = ['members'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid =$uuid;
        });
    }

    public function members(){
//        return $this->hasOne(Member::class, 'customer_id', 'id');
        return $this->belongsTo(Member::class, 'id', 'customer_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'order_id', 'id');
    }
}
