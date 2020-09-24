<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Partner;

class Order extends Model
{
    protected $fillable = [
      'status', 'client_email', 'partner_id',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('quantity');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'internal_id', 'status');
    }

    public static function getStatuses()
    {
        return [
          0 => 'Новый',
          10 => 'Подтверждён',
          20 => 'Завершён',
        ];
    }
}
