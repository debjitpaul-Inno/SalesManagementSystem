<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;



class Vendor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded= ['id', 'uuid'];
    protected $casts = ['vendor_address'=>'array'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid = $uuid;
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'vendor_id');
    }


}
