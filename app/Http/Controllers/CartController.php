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

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('success', 'Your cart is empty.');
        }

        DB::transaction(function () use ($cartItems) {
            $totalAmount = $cartItems->sum(function ($item) {
                return ($item->product->price ?? 0) * ($item->quantity ?? 1);
            });

            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_amount' => $totalAmount,
            ]);

            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name ?? 'Product',
                    'price' => $item->product->price ?? 0,
                    'quantity' => $item->quantity ?? 1,
                    'variation' => $item->variation,
                ]);
            }

            $user = Auth::user();

            StoreNotification::create([
                'audience' => 'admin',
                'title' => 'New order placed',
                'message' => $user->name.' placed Order #'.$order->id.' with '.count($cartItems).' item(s).',
                'type' => 'order_placed',
            ]);

            StoreNotification::create([
                'user_id' => $user->id,
                'audience' => 'user',
                'title' => 'Order placed',
                'message' => 'Your Order #'.$order->id.' has been placed successfully and is now pending confirmation.',
                'type' => 'order_status',
            ]);

            Cart::where('user_id', $user->id)->delete();
        });

        return redirect('/')->with('success', 'Order placed!');
    }
}
