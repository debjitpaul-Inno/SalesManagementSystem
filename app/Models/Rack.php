<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Rack extends Model
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
    protected $softCascade = ['products'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_racks');
    }

    public function shelves()
    {
        return $this->belongsTo(Shelf::class, 'shelf_id', 'id');
    }


}
