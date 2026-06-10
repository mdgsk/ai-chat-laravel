<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\HelloController;
// use App\Http\Controllers\FormController;

use App\Models\Conversation;
use App\Models\ChatHistory;

use App\Http\Controllers\ConversationController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/hello', function () {
//     // return 'Hello World';
//     return view('hello', [
//         'name' => 'Gaffar'
//     ]);
// });

// Route::get('/hello', [HelloController::class, 'index']);

// Route::get('/hello/{name}', [HelloController::class, 'index']);

// Route::get('/hello/{name}', [HelloController::class, 'index'])->name('hello');

// Route::get('/form', function () {
//     return view('form');
// });

// Route::post('/submit', function (Request $request) {
//     $request->validate([
//         'name' => 'required|min:3'
//     ]);
//     return $request->name;
// });

// Route::get('/form', [FormController::class, 'show']);
// Route::post('/submit', [FormController::class, 'submit']);

// Route::get('/form', [FormController::class, 'show'])->name('form.show');
// Route::post('/submit', [FormController::class, 'submit'])->name('form.submit');


Route::get('/test', function () {

    // $conversation = Conversation::create([
    //     'title' => 'New Chat'
    // ]);

    // return 'Conversation created successfully!';

    // return Conversation::all();

    // return Conversation::find(3);

    // Conversation::
    //     where(...)
    //     ->orderBy(...)
    //     ->limit(...)
    //     ->get();

    // return Conversation::where(
    //     'title',
    //     'New Chat'
    // )->first();

    // return Conversation::orderBy('id', 'desc')->get();

    // return Conversation::latest()->get();

    // $conversation = Conversation::first();
    // ChatHistory::create([
    //     'conversation_id' => $conversation->id,
    //     'question' => 'Hello',
    //     'answer' => 'Hi there!'
    // ]);
    // return 'Chat created';

    //  $chat = ChatHistory::first();
    // return $chat->conversation;

    // return Conversation::with('chatHistory')->get();

    // $conversation = Conversation::first();
    // $conversation->update([
    //     'title' => 'Updated Chat'
    // ]);
    // return $conversation;

    // $conversation = Conversation::first();
    // $conversation->delete();
    // return 'Deleted successfully';


    // return Conversation::all();
    // return Conversation::withTrashed()->get();
    // return Conversation::onlyTrashed()->get();
    // return Conversation::withTrashed()->restore();
    // return Conversation::withTrashed()->first()->restore();

    return Conversation::onlyTrashed()->first()->restore();

});