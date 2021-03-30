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
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (\Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route("customers.index");
        }

        return redirect()->back();

    }

    public function destroy()
    {
        \Auth::guard('customer')->logout();
        return redirect()->route("index");
    }
}
