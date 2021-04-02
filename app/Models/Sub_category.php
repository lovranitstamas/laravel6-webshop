<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{

    public $table = 'sub_categories';

    public function setAttributes($data)
    {
        $this->category_id = $data['category_id'];
        $this->name_hu = $data['name_hu'];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class,'sub_category_id','id');
    }
}
