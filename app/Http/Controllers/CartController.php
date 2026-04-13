<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->get();

        return view('cart.index', compact('cart'));
    }

    public function remove($id)
    {
        Cart::where('id', $id)->delete();

        return back();
    }

    public function checkout()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect('/')->with('success', 'Order placed!');
    }
}