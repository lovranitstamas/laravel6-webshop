<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mode_of_transport extends Model
{

    public $table = 'mode_of_transports';

    public function setAttributes($data)
    {
        $this->mode_hu = $data['mode_hu'];
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'mode_of_transport_id');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_mode_of_transport',
            'mode_of_transport_ids',
            'product_id')
            ->withTimestamps()
            ->withPivot(['weight']);
    }
}
