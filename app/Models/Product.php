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
}
