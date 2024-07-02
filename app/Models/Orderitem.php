<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Orderitem extends Model
{
    use HasFactory;

    public function product():hasOne{
        return $this->hasOne(Product::class,'id','product_id');
        // return $this->belongsTo(Product::class);

    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
