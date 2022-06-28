<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{

    use HasFactory;
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }

    // tai sao
    public function user()
    {
        return $this->belongsTo(Admin::class);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }
    protected $statusArr = [
        0 => 'Vô hiệu',
        1 => 'Kích hoạt',
    ];

    public function getStatusTextAttribute()
    {
        return $this->statusArr[$this->status];
    }
}
