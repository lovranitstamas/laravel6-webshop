<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function setAttributes($data)
    {
        $this->customer_id = authCustomer()->id;
        $this->product_id = $data['product_id'];
        $this->content = $data['content'];
    }

}
