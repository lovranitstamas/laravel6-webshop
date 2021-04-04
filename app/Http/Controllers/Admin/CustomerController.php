<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    public function index(Request $request)
    {

        $customers = Customer::all();

        return view('admin.customer.index')
            ->with('customers', $customers);

    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($categoryId)
    {

    }

    public function edit($categoryId)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request, $id)
    {

    }

}
