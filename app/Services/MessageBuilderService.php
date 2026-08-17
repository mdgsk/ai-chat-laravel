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
            'content' => config('prompts.' . config('ai.prompt'))
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

        // foreach ($messages as $index => $message) {
        //     if ($index === array_key_last($messages)) {
        //         $prompt .= "Current User Question:\n"
        //             . $message['content']
        //             . "\n\n";
        //         continue;
        //     }

        //     $prompt .= ucfirst($message['role'])
        //         . ': '
        //         . $message['content']
        //         . "\n\n";
        // }

        // $prompt .= "System Instructions:\n"
        //     . $messages[0]['content']
        //     . "\n\n";

        $prompt .= "System Instructions:\n"
            . $messages[0]['content']
            . "\n\n"
            // . "Use the Conversation History to understand the context of the current user question, "
            // . "including short follow-up questions and references to previous messages.\n\n";
            . "Use the Conversation History to understand the context of the current user question, "
            . "including short follow-up questions and references to previous messages. "
            . "Answer the Current User Question directly and use the conversation history only as context.\n\n";

        $prompt .= "Conversation History:\n\n";

        foreach (array_slice($messages, 1, -1) as $message) {
            $prompt .= ucfirst($message['role'])
                . ': '
                . $message['content']
                . "\n\n";
        }

        $prompt .= "Current User Question:\n"
            . end($messages)['content']
            . "\n\n";

        return $prompt;
    }


}