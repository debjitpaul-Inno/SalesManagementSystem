<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [
        'id',
        'uuid',
    ];
    protected $casts = [
        'present_address' => 'array',
        'permanent_address' => 'array'
    ];

    static public function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $model->uuid = Str::uuid();
        });
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
