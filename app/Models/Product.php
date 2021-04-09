<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends SearchModel
{

    public function setAttributes($data)
    {
        $this->name_hu = $data['name_hu'];
        $this->sub_category_id = $data['sub_category_id'];
        $this->state = $data['state'];
        $this->inventory = $data['inventory'];
        $this->price_hu = $data['price_hu'];
        $this->payment_unit = $data['payment_unit'];
    }

    public function subCategory()
    {
        //foreignKey, ownerKey
        return $this->belongsTo(Sub_category::class);
    }

    public function category()
    {
        return $this->hasManyThrough(
            Category::class,
            Sub_category::class,
            'category_id',
            'id',
            'sub_category_id',
            'id'
        );
    }

    /*public function modeOfTransport()
    {
        return $this->belongsTo(Mode_of_transport::class, 'mode_of_transport_id', 'id');
    }*/

    public function modeOfTransports()
    {
        return $this->belongsToMany(
            Mode_of_transport::class,
            'product_mode_of_transport',
            'product_id',
            'mode_of_transport_id')
            ->withTimestamps();
        //->withPivot(['weight']);
    }

    public function hasModeOfTransport($transportId)
    {
        return in_array($transportId, $this->modeOfTransports()->pluck('id')->toArray());
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeOrderColumn($query, $data)
    {
        if (isset($data['orderBy']) && $data['orderBy']) {
            $query->orderBy($data['orderBy'], $data['orderDir']);
        }
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
