<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom_user extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'fullname',
        'phone',
        'address',
    ];

    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'custom_id');
    }
}
