<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\StoreNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Show checkout page
     */
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cartItems->sum(function ($item) {
            return ($item->product->price ?? 0) * ($item->quantity ?? 1);
        });

        $user = Auth::user();

        return view('checkout.index', [
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount,
            'user' => $user,
        ]);
    }

    /**
     * Process order confirmation
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cod,gcash,maya',
            'gcash_number' => 'required_if:payment_method,gcash|nullable|string|regex:/^09[0-9]{9}$/',
            'maya_email' => 'required_if:payment_method,maya|nullable|email',
        ]);

        $paymentMethod = $request->payment_method;

        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty.',
                ], 400);
            }
            return redirect('/cart')->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cartItems->sum(function ($item) {
            return ($item->product->price ?? 0) * ($item->quantity ?? 1);
        });

        $user = Auth::user();

        $order = DB::transaction(function () use ($cartItems, $user, $totalAmount, $paymentMethod) {
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'payment_status' => ($paymentMethod === 'cod') ? 'pending' : 'confirmed',
                'payment_method' => $paymentMethod,
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

            // Deduct product stock if available
            foreach ($order->items as $orderItem) {
                if ($orderItem->product) {
                    $orderItem->product->decrement('stock', $orderItem->quantity);
                }
            }

            // Create notifications
            StoreNotification::create([
                'audience' => 'admin',
                'title' => 'New Order #' . $order->id,
                'message' => $user->name . ' placed order via ' . strtoupper($paymentMethod) . ' (PHP ' . number_format($totalAmount, 2) . ')',
                'type' => 'new_order',
            ]);

            StoreNotification::create([
                'user_id' => $user->id,
                'title' => 'Order #' . $order->id . ' Confirmed',
                'message' => 'Thank you for your order! Track status in Orders.',
                'type' => 'order_confirmed',
            ]);

            // Clear cart
            Cart::where('user_id', $user->id)->delete();

            return $order;
        });

        $redirectUrl = route('payment.success', $order->id);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order_id' => $order->id,
                'redirect_url' => $redirectUrl,
            ]);
        }

        return redirect($redirectUrl)->with('success', 'Order placed successfully!');
    }

    /**
     * Payment success page
     */
    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product', 'user');

        return view('checkout.success', compact('order'));
    }

    /**
     * e-Receipt download
     */
    public function receipt(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product', 'user');

        $pdf = app('dompdf.wrapper');
        $pdf = $pdf->loadView('checkout.receipt', compact('order'));

        return $pdf->download('receipt-order-' . $order->id . '.pdf');
    }

    /**
     * Payment failed page
     */
    public function failed()
    {
        return view('checkout.failed');
    }
}

