<h1>{{ $conversation->title }}</h1>

<p>Conversation ID: {{ $conversation->id }}</p>


@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="{{ route('conversations.update', $conversation) }}" method="POST">
    @csrf
    @method('PUT')

    <input
        type="text"
        name="title"
        value="{{ old('title', $conversation->title) }}"
    >

    <button type="submit">
        Rename
    </button>
</form>

<form action="{{ route('conversations.destroy', $conversation) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit">
        Delete Conversation
    </button>
</form>