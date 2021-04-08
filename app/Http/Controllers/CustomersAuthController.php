<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomersAuthController extends Controller
{

    public function index(Request $request)
    {

        return view('frontend.auth.index')
            ->with('customers', authCustomer());

    }

    public function create()
    {
        return view('frontend.auth.create');
    }

    public function store(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = \Validator::make($request->toArray(), $rules);
        $errors = $validator->messages();

        //$this->validate($request, $rules);
        if (!count($errors->messages())) {
            $credentials = $request->only('email', 'password');

            if (\Auth::guard('customer')->attempt($credentials)) {
                return redirect()->route("customers.index");
            }

            //$errors = ['error' => 'Email és/vagy jelszó nem megfelelő'];

        }

        return redirect()->back()->with('errors', $errors);

    }

    public function edit()
    {

        //try {

        $user = Customer::findOrFail(authCustomer()->id);
        return view('frontend.auth.edit')->with('user', $user);
        /*} catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }*/

        //return redirect()->back();

    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'surname' => 'required',
            'forename' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:customers,email,' . authCustomer()->id,
            'password' => 'nullable|min:5|confirmed',
        ]);

        try {

            $customer = Customer::findOrFail(authCustomer()->id);

            $customer->setAttributes($request->all());

            try {
                $customer->save();
                session()->flash('success', 'Módosítás megtörtént');
            } catch (\Exception $e) {
                session()->flash('error', $e->getMessage());
            }

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();

    }

    public function destroy()
    {
        \Auth::guard('customer')->logout();
        return redirect()->route("index");
    }

    public function orderings()
    {

        try {

            $orders = Order::where('customer_id', authCustomer()->id)->get();

            return view('frontend.shop.orderings')
                ->with('orders', $orders);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
