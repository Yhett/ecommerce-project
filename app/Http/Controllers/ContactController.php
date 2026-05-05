<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\StoreNotification;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $message = ContactMessage::create($request->all());

        // Notify admin with link to message
        StoreNotification::create([
            'title' => 'New Contact Message from ' . $request->name,
            'message' => $request->message,
            'audience' => 'admin',
            'type' => 'contact_message',
        ]);

        return redirect()->back()->with('success', 'Message sent successfully! We will respond soon.');
    }
}

