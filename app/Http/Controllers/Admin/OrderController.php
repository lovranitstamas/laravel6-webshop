<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index(Request $request)
    {

        $orders = Order::all();

        return view('admin.order.index')
            ->with('orders', $orders);

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
