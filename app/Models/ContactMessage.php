<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'subject', 
        'message',
        'reply',
        'admin_id'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getStatusAttribute(): string
    {
        return $this->replied_at ? 'Replied' : 'Unread';
    }
}

