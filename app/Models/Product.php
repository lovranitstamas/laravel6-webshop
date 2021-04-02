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

    public function modeOfTransports()
    {
        return $this->belongsToMany(
            Mode_of_transport::class,
            'product_mode_of_transport',
            'product_id',
            'mode_of_transport_id')
            ->withTimestamps()
            ->withPivot(['weight']);
    }
}
