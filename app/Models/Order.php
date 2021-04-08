<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    public function setAttributes($data)
    {
        $this->customer_id = authCustomer()->id;
        $this->product_id = $data['product_id'];
        $this->quantity = $data['quantity'];
        $this->transport_id = $data['transport_id'];
        $this->total_amount = $this->quantity * $data['price_hu'];

        $transport = Mode_of_transport::where('id', $this->transport_id)->first();
        if ($transport->extra_cost != null) {
            $this->total_amount += $transport->extra_cost;
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function transport()
    {
        return $this->belongsTo(Mode_of_transport::class, 'transport_id', 'id');
    }

}

