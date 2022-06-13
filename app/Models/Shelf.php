<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Shelf extends Model
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
    protected $softCascade = ['racks'];

    public function racks()
    {
        return $this->hasMany(Rack::class, 'id', 'shelf_id');
    }
    public function stores()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

}
