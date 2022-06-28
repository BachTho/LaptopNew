<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $statusArr = [
        '0' => 'Đã đặt hàng',
        '1' => 'Đơn hàng đã được xác nhận',
        '2' => 'Đang vận chuyển',
        '3' => 'Đơn hàng có yêu cầu hủy',
        '4' => 'Đơn hàng đã hủy',
        '5' => 'Đã giao hàng',
    ];

    public function getStatusTextAttribute()
    {
        return $this->statusArr[$this->status];
    }

    public function custom_users()
    {
        return $this->belongsTo(Custom_user::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withTimestamps();;
    }
}
