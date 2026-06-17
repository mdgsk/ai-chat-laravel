<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class MessageBuilderService
{
    public function buildMessages(string $question, Collection $chats): array
    {
        $messages = [];

        $messages[] = [
            'role' => 'system',
            'content' => config('ai.system_prompt')
        ];

        foreach ($chats as $chat) {
            $messages[] = [
                'role' => 'user',
                'content' => $chat->question
            ];

            $messages[] = [
                'role' => 'assistant',
                'content' => $chat->answer
            ];
        }

        $messages[] = [
            'role' => 'user',
            'content' => $question
        ];

        return $messages;
    }


    public function buildPrompt(string $question, Collection $chats): string
    {
        $messages = $this->buildMessages(
            $question,
            $chats
        );

        $prompt = '';

        foreach ($messages as $message) {
            $prompt .= ucfirst($message['role'])
                . ': '
                . $message['content']
                . "\n\n";
        }

        return $prompt;
    }


}