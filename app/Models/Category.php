<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $table = 'categories';

    public function setAttributes($data)
    {
        $this->name_hu = $data['name_hu'];
    }

    public function subCategories()
    {
        return $this->hasMany(Sub_category::class);
    }
}
