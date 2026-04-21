<?php

namespace App\Http\Controllers;

use App\Models\StoreNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = StoreNotification::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        StoreNotification::where('user_id', $request->user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('notifications.index', compact('notifications'));
    }
}
