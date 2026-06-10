<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;


class AiService
{
    
    // public function ask(string $question, string $provider = 'gemini'): array
    public function ask(string $question, Collection $recentChats, string $provider = 'gemini'): array
    {
        // die('aaaaaaaaaaaaaaaaaaa');
        sleep(3);

        if ($provider === 'gemini') {
            return $this->askGemini($question, $recentChats);
        }

        if ($provider === 'ollama') {
            return $this->askOllama($question, $recentChats);
        }

        // return 'Unsupported provider';
        return $this->aiResponse(
            false,
            'Unsupported provider',
            'NA',
            'NA'
        );
    }


    private function askGemini(string $question, Collection $recentChats): array
    {
        $provider = 'gemini';
        $model = env('GEMINI_MODEL');
        $key = env('GEMINI_API_KEY');

        $context = $this->buildContext($recentChats);

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/'
        . $model
        . ':generateContent?key='
        . $key;

        $fullPrompt = env('SYSTEM_PROMPT')
            . "\n\n"
            . $context
            . "\n\nActual User Message:\n"
            . $question
            . "\n\nAssistant:";

        $payload = [
            'contents' => [[
                'parts' => [[
                    'text' => $fullPrompt
                ]]
            ]]
        ];

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($payload)
        ]);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return $this->aiResponse(
                false,
                curl_error($ch),
                $provider,
                $model
            );
        }
        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['error'])) {
            return $this->aiResponse(
                false,
                $result['error']['message'],
                $provider,
                $model
            );
        }

        if (!isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            return $this->aiResponse(
                false,
                'No response received from Gemini.',
                $provider,
                $model
            );
        }

        return $this->aiResponse(
            true,
            $result['candidates'][0]['content']['parts'][0]['text'],
            $provider,
            $model
        );
    }


    private function askOllama(string $question, Collection $recentChats): array
    {
        return $this->aiResponse(
            true,
            'Dummy Ollama response',
            'ollama',
            'llama3'
        );
    }


    private function aiResponse(bool $success, string $message, string $provider, string $model): array
    {
        return [
            'success' => $success,
            'message' => $message,
            'provider' => $provider,
            'model' => $model
        ];
    }


    private function buildContext(Collection $chats): string
    {
        $context = '';

        foreach ($chats as $chat) {
            $context .= "User: {$chat->question}\n";
            $context .= "Assistant: {$chat->answer}\n\n";
        }

        return $context;
    }


}