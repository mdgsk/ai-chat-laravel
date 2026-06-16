<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class PromptBuilderService
{
    public function buildContext(Collection $chats): string
    {
        $context = '';

        foreach ($chats as $chat) {
            $context .= "User: {$chat->question}\n";
            $context .= "Assistant: {$chat->answer}\n\n";
        }

        return $context;
    }

    public function buildPrompt(string $question, Collection $chats): string
    {
        $context = $this->buildContext($chats);

        // return env('SYSTEM_PROMPT')
        //     . "\n\n"
        //     . $context
        //     . "\n\nActual User Message:\n"
        //     . $question
        //     . "\n\nAssistant:";

        $systemPrompt = env('SYSTEM_PROMPT');

        return <<<PROMPT
        {$systemPrompt}

        {$context}

        Actual User Message:
        {$question}

        Assistant:
        PROMPT;

    }
}