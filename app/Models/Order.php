<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Order; 

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'foodname',
        'quantity',
        'price',
        'address_id', 

    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');

    }

    public function Orderitem():HasMany{
        return $this->hasMany(Orderitem::class,'order_id','id','address_id');
    }

    
    public function payment()
   {
    return $this->hasOne(Payment::class);
   }


    // public function users():HasOne{
    //     return $this->HasOne(User::class,'id','user_id');
    // }



    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    

    
}
