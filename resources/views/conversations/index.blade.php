<h1>Conversations</h1>

<ul>
    @forelse ($conversations as $conversation)
        <li>
            <a href="{{ route('conversations.show', $conversation) }}">
                {{ $conversation->title }}
            </a>
        </li>
    @empty
        <li>No conversations found.</li>
    @endforelse
</ul>


@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="{{ route('conversations.store') }}" method="POST">
    @csrf

    <input
        type="text"
        name="title"
        value="{{ old('title') }}"
    >

    <button type="submit">
        Create Conversation
    </button>
</form>