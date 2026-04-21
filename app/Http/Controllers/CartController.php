<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\StoreNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->get();

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $product_id)
    {
        $request->validate([
            'qty' => 'nullable|integer|min:1',
            'variation' => 'nullable|string'
        ]);

        $cartItem = Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'quantity' => $request->input('qty', 1),
            'variation' => $request->variation ?? 'Default'
        ]);

        $cartItem->load('product', 'user');

        StoreNotification::create([
            'audience' => 'admin',
            'title' => 'Cart update',
            'message' => $cartItem->user->name.' added '.$cartItem->quantity.' x '.($cartItem->product->name ?? 'a product').' to cart.',
            'type' => 'cart_added',
        ]);

        return redirect('/cart')->with('success', 'Added to cart!');
    }

    public function remove($id)
    {
        Cart::where('id', $id)->delete();

        return back();
    }

}