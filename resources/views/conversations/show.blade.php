@extends('layouts.app')

@section('content')

@php
    $markdownService = app(App\Services\MarkdownService::class);
@endphp

<div class="container">

    <div class="app-layout">

        <div class="sidebar">

            <a
                href="{{ route('conversations.create') }}"
                class="new-chat-btn"
            >
                + New Chat
            </a>

            <h4>Chats</h4>

            @foreach ($conversations as $item)

                <div class="conversation-item">

                    <a
                        href="{{ route('conversations.show', $item) }}"
                        class="conversation-link {{ $conversation && $item->id == $conversation->id ? 'active' : '' }}"
                    >
                        {{ $item->title }}
                    </a>

                </div>

            @endforeach

        </div>

        <div class="main-content">

        @if ($conversation)

            <div class="chat-form">

                <h2>Ask AI</h2>

                <form id="chat-form" action="#">
                    @csrf

                    <input
                        type="hidden"
                        name="conversation_id"
                        value="{{ $conversation->id }}"
                    >

                    <textarea
                        id="question"
                        name="question"
                        placeholder="Ask something..."
                        required
                    ></textarea>

                    <button
                        id="submit-btn"
                        type="submit"
                    >
                        Ask AI
                    </button>

                    <div
                        id="loading-message"
                        class="loading-message"
                    >
                        Thinking...
                    </div>

                </form>

            </div>

            <h3 class="history-title">
                Chat History
            </h3>

            <div id="chat-history-container">

                @forelse ($conversation->chatHistory as $chat)

                    <div class="chat-pair">

                        <div class="message-row user-message">
                            <div class="message-bubble">
                                {{ $chat->question }}
                            </div>
                        </div>

                        <div class="message-row assistant-message">
                            <div class="message-bubble">

                                <div class="answer-content">
                                    {!! $markdownService->render($chat->answer) !!}
                                </div>

                                <div class="chat-meta">
                                    {{ $chat->provider }}
                                    |
                                    {{ $chat->model }}
                                    |
                                    {{ $chat->created_at->format('d M H:i') }}
                                </div>

                            </div>
                        </div>

                    </div>

                @empty

                    <p id="no-history-message">
                        No chat history available.
                    </p>

                @endforelse

            </div>

        @else

            <div class="empty-state">
                Select an existing chat or click New Chat to start.
            </div>

        @endif

        </div>

    </div>

</div>

@endsection