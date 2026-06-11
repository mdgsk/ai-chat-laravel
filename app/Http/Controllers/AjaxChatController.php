<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarkdownService;
use Illuminate\Support\Facades\Validator;

use App\Models\ChatHistory;
use App\Models\Conversation;
use App\Services\AiService;


class AjaxChatController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'question' => 'required|min:2'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

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

        if ($response['success']) {
            ChatHistory::create([
                'conversation_id' => $request->conversation_id,
                'question' => $request->question,
                'answer' => $response['message'],
                'provider' => $response['provider'],
                'model' => $response['model'],
                'time_taken' => $timeTaken
            ]);
        }

        $conversation = Conversation::find(
            $request->conversation_id
        );

        if (str_starts_with($conversation->title, 'New Chat')) {
            $conversation->update([
                'title' => mb_substr(
                    trim($request->question),
                    0,
                    50
                )
            ]);
        }

        $conversation->touch();

        $markdownService = new MarkdownService();

        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'html' => $markdownService->render(
                $response['message']
            ),
            'provider' => $response['provider'],
            'model' => $response['model'],
            'time_taken' => $timeTaken,
            'timestamp' => now()->format('d M H:i')
        ]);

    }

}
