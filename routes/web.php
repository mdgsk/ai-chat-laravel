<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Conversation;
use App\Models\ChatHistory;

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\AjaxChatController;


Route::get('/', [ConversationController::class, 'index'])
    ->name('conversations.index');

Route::get('/conversations/create', [ConversationController::class, 'create'])
    ->name('conversations.create');

Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])
    ->name('conversations.show');

Route::delete('/conversations/{conversation}', [ConversationController::class, 'destroy'])
    ->name('conversations.destroy');

Route::post('/ajax-chat', [AjaxChatController::class, 'store'])
    ->name('ajax-chat.store');

