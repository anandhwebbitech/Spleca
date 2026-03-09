<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    const PENDING = 1;
    const DELIVERED =2;
    const CONFIRM = 3;
    const CANCEL = 4;
    const RETURN =5;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function address()
    {
        return $this->belongsTo(CustomerAddress::class, 'address_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}
