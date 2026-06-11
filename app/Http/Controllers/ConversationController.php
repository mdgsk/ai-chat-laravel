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
        $conversations = Conversation::latest('updated_at')->get();
        $conversation = $conversations->first();

        return view(
            'conversations.show',
            [
                'conversations' => $conversations,
                'conversation' => $conversation
            ]
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
        $conversation->load([
            'chatHistory' => function ($query) {
                $query->latest();
            }
        ]);

        $conversations = Conversation::latest('updated_at')->get();

        return view(
            'conversations.show',
            [
                'conversation' => $conversation,
                'conversations' => $conversations
            ]
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
        //
    }

}
