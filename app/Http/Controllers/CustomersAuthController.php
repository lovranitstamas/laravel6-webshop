<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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

    public function destroy()
    {
        \Auth::guard('customer')->logout();
        return redirect()->route("index");
    }
}
