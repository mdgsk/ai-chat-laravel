<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarkdownService;
use App\Models\ChatHistory;
use App\Models\Conversation;
use App\Services\AiService;


class AjaxChatController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required',
            'question' => 'required|min:1'
        ]);

        $recentChats = ChatHistory::where(
            'conversation_id',
            $request->conversation_id
        )
        ->latest()
        ->take(5)
        ->get()
        ->reverse();

        $aiService = new AiService();
        $startTime = microtime(true);
        $response = $aiService->ask($request->question, $recentChats);
        $timeTaken = round(microtime(true) - $startTime, 2);

        ChatHistory::create([
            'conversation_id' => $request->conversation_id,
            'question' => $request->question,
            'answer' => $response['message'],
            'provider' => $response['provider'],
            'model' => $response['model'],
            'time_taken' => $timeTaken
        ]);

        $conversation = Conversation::find(
            $request->conversation_id
        );

        $conversation->touch();

        // return response()->json([
        //     'success' => true
        // ]);

        $markdownService = new MarkdownService();

        return response()->json([
            'success' => true,
            'message' => $response['message'],
            'html' => $markdownService->render(
                $response['message']
            ),
            'provider' => $response['provider'],
            'model' => $response['model'],
            'time_taken' => $timeTaken
        ]);


    }

}
