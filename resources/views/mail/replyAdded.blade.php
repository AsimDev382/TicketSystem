<h1>New Reply on Ticket: {{ $ticket->title }}</h1>

<p><strong>Reply from:</strong> {{ $reply->user->name }}</p>
<p><strong>Message:</strong> {{ $reply->message }}</p>
<p><strong>Time:</strong> {{ $reply->created_at->format('Y-m-d H:i:s') }}</p>

<a href="{{ route('tickets.show', $ticket->id) }}">View Ticket</a>
