<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Product extends Model
{
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }
}
