<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    public function setAttributes($data)
    {
        $this->customer_id = authCustomer()->id;
        $this->product_id = $data['product_id'];
        $this->value = $data['value'];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
