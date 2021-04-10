<?php

namespace App\Http\Controllers;

use App\Mail\Confirmation;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function order($productId)
    {
        try {

            $product = Product::findOrFail($productId);

            return view('frontend.shop.order')
                ->with('product', $product);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|min:1|max:32767|integer',
            'transport_id' => 'required|not_in:0'
        ]);

        $order = new Order();
        $order->setAttributes($request->all());

        try {

            $product = Product::where('id', $request->input('product_id'))->first();
            $product->inventory -= $request->input('quantity');

            if ($product->inventory >= 0) {

                $product->save();
                $order->save();

                $to_email = authCustomer()->email;
                Mail::to($to_email)
                    ->send(
                    new Confirmation(
                        $order,
                        $product,
                        authCustomer()
                    )
                );
                //TODO transaction

                session()->flash('success', 'Rendelés elmentve');
            } else {
                $rest = ($request->input('quantity') - (0 - $product->inventory));
                session()->flash('error',
                    $rest > 0 ? 'Maximálisan rendelhető darabszám: ' . $rest . ' db.' : "A termék nincs raktáron. Szíves türelmét kérjük.");
                // 150 - (0 - (-50)) = 100  if the inventory = 100 and the order 150
                // 30 - (0- (-22)) = 8          8 , 30
            }

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function opinion($orderId, $productId)
    {
        try {

            $order = Order::where('id', $orderId)
                ->where('customer_id', authCustomer()->id)
                ->firstOrFail();

            $comment = Comment::where('customer_id', authCustomer()->id)->where('product_id', $productId)->first();
            $rating = Rating::where('customer_id', authCustomer()->id)->where('product_id', $productId)->first();

            return view('frontend.shop.opinion')
                ->with('order', $order)
                ->with('comment', $comment)
                ->with('rating', $rating);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function comment(Request $request)
    {

        $this->validate($request, [
            'content' => 'required|min:20'
        ]);

        $comment = new Comment();
        $comment->setAttributes($request->all());

        try {

            $comment->save();
            session()->flash('success', 'Értékelés elmentve');

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function rating(Request $request)
    {

        $this->validate($request, [
            'value' => 'required|between:1,5|not_in:0'
        ]);

        $rating = new Rating();
        $rating->setAttributes($request->all());

        try {

            $rating->save();
            session()->flash('success', 'Értékelés elmentve');

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
