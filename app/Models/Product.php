<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Whistlist;
use App\Models\Order;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function whistlist()
    {
        return $this->belongsTo(Whistlist::class);
    }
}
