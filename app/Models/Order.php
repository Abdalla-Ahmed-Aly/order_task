<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order_Item;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total_price', 'quantity'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    
    }
    
    public function orderItems(){
        return $this->hasMany(orderItem::class);
    
    }}
