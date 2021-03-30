<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{

    public $table = 'customers';

    public function lastUpdated()
    {
        return $this->updated_at->format('Y-m-d H:i:s');
    }


    public function setAttributes($data)
    {

        $this->surname = $data['surname'];
        $this->forename = $data['forename'];
        $this->zipcode = $data['zipcode'];
        $this->city = $data['city'];
        $this->address = $data['address'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];

        if (isset($data['password']) && $data['password']) {
            $this->password = \Hash::make($data['password']);
        }
    }
}
