@extends('layouts.app')

@section('content')

@php
    $markdownService = app(App\Services\MarkdownService::class);
@endphp

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

<h1>{{ $conversation->title }}</h1>

<hr>

<h2>Messages</h2>

@forelse ($conversation->chatHistory as $chat)

    <div>
        <strong>You:</strong>
        {{ $chat->question }}
    </div>

    <div>
        <strong>AI:</strong>
        {!! $markdownService->render($chat->answer) !!}
    </div>

    <hr>

@empty

    <p>No messages yet.</p>

@endforelse


<hr>

<form action="{{ route('chat-histories.store') }}" method="POST">
    @csrf

    <input
        type="hidden"
        name="conversation_id"
        value="{{ $conversation->id }}"
    >

    <textarea
        name="question"
        rows="5"
        cols="50"
    ></textarea>

    <br><br>

    <button type="submit">
        Send
    </button>
</form>

@endsection