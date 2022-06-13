<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [
        'id', 'uuid'
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $uuid = Str::uuid();
            $model->uuid =$uuid;

            $today = date("Ymd");
            $rand = substr(uniqid(sha1(time())),0,2);
            $unique = $today . $rand;
            $model->tx_number = 'TX-'.$unique;
        });
    }

    public function accounts()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
