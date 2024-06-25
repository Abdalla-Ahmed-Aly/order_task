<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{

    protected $fillable = ['name','quantity', 'description','price'];
    use HasFactory;
    public function orderItems(){
        return $this->hasMany(orderItem::class);
    }
    



}
