<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {

        //$products = Product::all();

        $search = $request->input('search');
        $search['sort_by'] = $request->input('orderBy');
        $search['sorting_direction'] = $request->input('orderDir');

        //$products = Product::orderColumn($search)->where('state', 1)->paginate(2);
        $products = Product::search($search)->where('state', 1)->paginate(2);

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
