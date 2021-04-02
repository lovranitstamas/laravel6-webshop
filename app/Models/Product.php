<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function subCategory()
    {
        //foreignKey, ownerKey
        return $this->belongsTo(Sub_category::class);
    }

    public function modeOfTransport()
    {
        return $this->belongsTo(Mode_of_transport::class,'mode_of_transport_id','id');
    }
}
