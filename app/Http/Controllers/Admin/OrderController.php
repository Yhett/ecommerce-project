<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\StoreNotification;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items'])->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,packed,out_for_delivery',
        ]);

        $previousStatus = $order->status;
        $order->update(['status' => $validated['status']]);

        if ($previousStatus !== $validated['status']) {
            StoreNotification::create([
                'user_id' => $order->user_id,
                'audience' => 'user',
                'title' => 'Order status updated',
                'message' => 'Your Order #'.$order->id.' is now '.str_replace('_', ' ', $validated['status']).'.',
                'type' => 'order_status',
            ]);
        }

        return back()->with('success', 'Order status updated successfully.');
    }
}
