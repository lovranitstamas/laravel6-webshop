<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{

    public function create()
    {
        return view('frontend.account.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'surname' => 'required',
            'forename' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:5|confirmed',
            'terms' => 'accepted'
        ]);

        $customer = new Customer();

        $customer->setAttributes($request->all());
        $customer->save();

        session()->flash('message', 'Köszönjük a regisztrációt');

        return redirect()->back();
    }

}
