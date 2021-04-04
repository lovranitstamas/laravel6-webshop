<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_state extends Model
{

    public function order()
    {
        return $this->belongsTo(Order::class, 'id', 'id');
    }

}

