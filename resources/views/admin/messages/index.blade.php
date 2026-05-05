@extends('admin.layout')

@section('title', 'Contact Messages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Contact Messages ({{ $messages->total() }})</h1>
    <a href="/admin" class="btn btn-secondary">Back to Dashboard</a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        @if($messages->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr class="@if($message->replied_at) table-success @endif">
                                <td>
                                    <strong>{{ $message->name }}</strong>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-success me-1" onclick="copyEmail('{{ $message->email }}')">
                                        <i class="fa fa-copy"></i> {{ Str::limit($message->email, 25) }}
                                    </button>
                                </td>
                                <td>{{ Str::limit($message->subject ?: 'No Subject', 30) }}</td>
                                <td>
                                    <span class="badge {{ $message->replied_at ? 'bg-success' : 'bg-warning' }}">
                                        {{ $message->replied_at ? 'Replied' : 'Unread' }}
                                    </span>
                                </td>
                                <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-primary" onclick="viewMessage('{{ $message->id }}')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        @if(!$message->replied_at)
                                            <button class="btn btn-sm btn-success" onclick="replyMessage('{{ $message->id }}')">
                                                <i class="fa fa-reply"></i>
                                            </button>
                                        @endif
                                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline" style="all:unset;display:contents;" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $messages->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-envelope fa-3x text-muted mb-4"></i>
                <h5 class="text-muted">No contact messages yet.</h5>
                <p class="text-muted">Messages from contact form will appear here.</p>
            </div>
        @endif
    </div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="messageContent">
                    Loading...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentMessageId = null;

function copyEmail(email) {
    navigator.clipboard.writeText(email).then(() => {
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa fa-check text-success"></i> Copied!';
        btn.classList.remove('btn-outline-success');
        btn.classList.add('btn-success');
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-success');
        }, 2000);
    });
}

function viewMessage(id) {
    currentMessageId = id;
    document.getElementById('modalTitle').textContent = 'Message Details';
    
    fetch(`/api/contact/${id}`)
        .then(res => res.json())
        .then(data => {
            let replySection = '';
            if (data.reply) {
                replySection = `
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="text-success"><i class="fa fa-reply me-1"></i>Reply Sent:</h6>
                        <div class="border-start border-success border-4 ps-3">
                            <small class="text-muted">By Admin on ${new Date(data.replied_at).toLocaleString()}</small>
                            <div class="bg-success-subtle p-3 rounded mt-2" style="white-space: pre-wrap;">${data.reply}</div>
                        </div>
                    </div>
                `;
            } else {
                replySection = `
                    <div class="reply-form mt-4 pt-4 border-top">
                        <h6 class="text-primary"><i class="fa fa-reply me-1"></i>Send Reply:</h6>
                        <form id="replyForm">
                            <div class="mb-3">
                                <textarea class="form-control" id="replyText" rows="5" placeholder="Type your reply here..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-paper-plane me-1"></i>Send Reply
                            </button>
                            <button type="button" class="btn btn-secondary ms-2" onclick="cancelReply()">Cancel</button>
                        </form>
                    </div>
                `;
            }

            document.getElementById('messageContent').innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6><strong>Name:</strong> ${data.name}</h6>
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> <span class="badge bg-primary ms-2 clickable-badge" onclick="copyEmail('${data.email}')" title="Click to copy">${data.email}</span>
                        </div>
                        <div class="mb-3">
                            <strong>Subject:</strong> ${data.subject || 'No subject'}
                        </div>
                        <div class="mb-3">
                            <strong>Status:</strong> <span class="badge ${data.replied_at ? 'bg-success' : 'bg-warning'}">${data.replied_at ? 'Replied' : 'Unread'}</span>
                        </div>
                        <div class="mb-3">
                            <strong>Sent:</strong> ${new Date(data.created_at).toLocaleString()}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <strong>Message:</strong>
                        <div class="border p-3 rounded mt-2 bg-light" style="min-height: 100px; white-space: pre-wrap;">${data.message.replace(/</g, '<').replace(/>/g, '>')}</div>
                    </div>
                </div>
                ${replySection}
            `;

            // Reply form handler
            const replyForm = document.getElementById('replyForm');
            if (replyForm) {
                replyForm.onsubmit = function(e) {
                    e.preventDefault();
                    const replyText = document.getElementById('replyText').value.trim();
                    if (!replyText) return;

                    fetch(`/admin/messages/${id}/reply`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                        },
                        body: JSON.stringify({ reply: replyText })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Error sending reply');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Error sending reply');
                    });
                };
            }

            new bootstrap.Modal(document.getElementById('messageModal')).show();
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Error loading message.');
        });
}

function replyMessage(id) {
    viewMessage(id);
}

function cancelReply() {
    const replySection = document.querySelector('.reply-form');
    if (replySection) {
        replySection.remove();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const token = document.querySelector('meta[name="csrf-token"]');
    if (!token) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = document.querySelector('input[name=_token]').value;
        document.head.appendChild(meta);
    }
});
</script>
@endsection

