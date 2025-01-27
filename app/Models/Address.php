<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'addresses';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    { 
        return $this->hasMany(Order::class, 'address_id', 'id');

    }

    public function orderItems()
    {
    return $this->hasMany(OrderItem::class, 'address_id');
    }


    
    
    
}
