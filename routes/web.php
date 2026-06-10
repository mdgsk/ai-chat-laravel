<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Conversation;
use App\Models\ChatHistory;

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ChatHistoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('conversations', ConversationController::class);
Route::resource('chat-histories', ChatHistoryController::class);

