<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;


class ConversationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $conversations = Conversation::latest('updated_at')->paginate(env('PAGINATE_CONVERSATION'));
        $conversations = Conversation::latest('updated_at')
        ->paginate(
            env('PAGINATE_CONVERSATION'),
            ['*'],
            'conversation_page'
        );
        $conversations->appends(request()->query());
        
        return view(
            'conversations.show',
            compact(
                'conversations'
            )
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $conversation = Conversation::create([
            'title' => 'New Chat ' . now()->format('H:i:s')
        ]);

        return redirect()->route(
            'conversations.show',
            $conversation
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
    }


    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
            $chatHistories = $conversation
        ->chatHistory()
        ->latest()
        ->paginate(
            env('PAGINATE_CHAT'),
            ['*'],
            'chat_page'
        );
        $chatHistories->appends(request()->query());

        $chatHistories->setCollection(
            $chatHistories->getCollection()
        );

        $conversations = Conversation::latest('updated_at')
        ->paginate(
            env('PAGINATE_CONVERSATION'),
            ['*'],
            'conversation_page'
        );
        $conversations->appends(request()->query());

        return view(
            'conversations.show',
            compact(
                'conversations',
                'conversation',
                'chatHistories'
            )
        );
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
    public function update(Request $request, Conversation $conversation)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        $conversation->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Rename the specified Conversation.
     */
    public function rename(Request $request, Conversation $conversation)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $conversation->update([
            'title' => $request->title
        ]);

        return response()->json([
            'success' => true
        ]);
    }

}
