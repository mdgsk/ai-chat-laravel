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

            @php
                $conversation_id = isset($conversation)
                    ? $conversation->id
                    : 0;
            @endphp

            @foreach ($conversations as $item)

                <div class="conversation-item">
                    <a 
                    href="{{ route(
                        'conversations.show',
                        [
                            'conversation' => $item,
                            'conversation_page' => request('conversation_page')
                        ]
                    ) }}"
                    class="conversation-link {{ $conversation_id == $item->id ? 'active' : '' }}">
                        <span class="conversation-title">
                            {{ Str::limit($item->title, 20) }}
                        </span>
                        <span class="conversation-actions">
                            <span class="edit-btn" data-id="{{ $item->id }}">✏️</span>
                            <span class="delete-btn" data-id="{{ $item->id }}">🗑️</span>
                        </span>
                    </a>
                </div>

            @endforeach

            @if ($conversations->hasPages())

                @if ($conversations->onFirstPage())
                    Previous
                @else
                    <a href="{{ $conversations->previousPageUrl() }}">
                        Previous
                    </a>
                @endif

                |

                @if ($conversations->hasMorePages())
                    <a href="{{ $conversations->nextPageUrl() }}">
                        Next
                    </a>
                @else
                    Next
                @endif

            @endif

        </div>

        <div class="main-content">

        @if (isset($conversation))

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
                        min="2"
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

                @forelse($chatHistories as $chat)

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

            @if ($chatHistories->hasMorePages())
                <a href="{{ $chatHistories->nextPageUrl() }}">
                    Load Older Messages
                </a>
            @endif

        @else

            <div class="empty-state">
                Select an existing chat or click New Chat to start.
            </div>

        @endif

        </div>

    </div>

</div>

@endsection