<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Member extends Model
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
    protected $softCascade = ['membershipTypes'];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
//        return $this->belongsTo(Customer::class, 'id', 'customer_id');
    }

//    public function customers(){
//        return $this->belongsTo(Customer::class, 'id', 'customer_id');
//    }
    public function membershipTypes(){
        return $this->belongsTo(MembershipType::class, 'membership_type_id', 'id');
    }
}
