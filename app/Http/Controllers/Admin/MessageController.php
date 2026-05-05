<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\StoreNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReply;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::with('admin')->latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        return response()->json($message->load('admin'));
    }

    public function reply(Request $request, ContactMessage $message)
    {
        $request->validate([
            'reply' => 'required|string|max:5000'
        ]);

        $message->update([
            'reply' => $request->reply,
            'replied_at' => now(),
            'admin_id' => Auth::id(),
        ]);

        // Send email reply
        try {
            Mail::to($message->email)->send(new ContactReply($message));
        } catch (\Exception $e) {
            // Log error but don't fail
            \Log::warning('Failed to send contact reply email: ' . $e->getMessage());
        }

        // Notify customer
        StoreNotification::create([
            'user_id' => null,
            'audience' => 'customer',
            'title' => 'Reply from Store',
            'message' => 'We have replied to your contact message: ' . ($message->subject ?: 'No subject'),
            'type' => 'contact_reply',
        ]);

        return response()->json(['success' => true, 'message' => 'Reply sent successfully!']);
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}

