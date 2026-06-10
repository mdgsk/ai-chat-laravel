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
        // $conversations = Conversation::latest()->get();
        $conversations = Conversation::latest('updated_at')->get();

         return view('conversations.index', [
            'conversations' => $conversations
        ]);
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
        $request->validate([
            'title' => 'required|min:3'
        ]);

        Conversation::create([
            'title' => $request->title
        ]);

        return redirect()->route('conversations.index')
            ->with('success', 'Conversation created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        $conversation->load('chatHistory');

        return view('conversations.show', [
            'conversation' => $conversation
        ]);
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
        $request->validate([
            'title' => 'required|min:3'
        ]);

        $conversation->update([
            'title' => $request->title
        ]);

        return redirect()
            ->route('conversations.show', $conversation)
            ->with('success', 'Conversation renamed successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        $conversation->delete();

        return redirect()
            ->route('conversations.index')
            ->with('success', 'Conversation deleted successfully!');
    }

}
