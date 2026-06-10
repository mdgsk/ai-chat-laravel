<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ChatHistory;
use App\Models\Conversation;

use App\Services\AiService;


class ChatHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'conversation_id' => 'required',
        //     'question' => 'required|min:1'
        // ]);

        // $recentChats = ChatHistory::where(
        //     'conversation_id',
        //     $request->conversation_id
        // )
        // ->latest()
        // ->take(5)
        // ->get()
        // ->reverse();

        // $aiService = new AiService();
        // $startTime = microtime(true);
        // $response = $aiService->ask($request->question, $recentChats);
        // $timeTaken = round(microtime(true) - $startTime, 2);

        // ChatHistory::create([
        //     'conversation_id' => $request->conversation_id,
        //     'question' => $request->question,
        //     'answer' => $response['message'],
        //     'provider' => $response['provider'],
        //     'model' => $response['model'],
        //     'time_taken' => $timeTaken
        // ]);


        // $conversation = Conversation::find(
        //     $request->conversation_id
        // );

        // // if (str_starts_with($conversation->title, 'New Chat')) {
        // //     $conversation->update([
        // //         'title' => mb_substr(
        // //             trim($request->question),
        // //             0,
        // //             50
        // //         )
        // //     ]);
        // // }

        // $conversation->touch();


        // return redirect()->route(
        //     'conversations.show',
        //     $request->conversation_id
        // );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
