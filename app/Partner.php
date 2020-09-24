<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Partner extends Model
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
