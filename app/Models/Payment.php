<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'address_id',
        'amount',
        'status',
        'payment_method',
        'transaction_id',
        
    ];

    // Define relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
