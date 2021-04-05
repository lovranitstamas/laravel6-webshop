<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {

        $products = Product::all();

        $search['orderBy'] = $request->input('orderBy');
        $search['orderDir'] = $request->input('orderDir');

        $products = Product::orderColumn($search)->get();
        return view('frontend.shop.index')
            ->with('products', $products);
    }

    public function show($productId)
    {

        try {

            $product = Product::findOrFail($productId);

            return view('frontend.shop.show')
                ->with('product', $product);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
