<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class AiService
{
    

    public function ask(string $question, Collection $recentChats, string $provider = 'gemini'): array
    {

        if (env('USE_LOCAL_LLM')) {
            return $this->askOllama(
                $question,
                $recentChats
            );
        }

        $response = $this->askGemini(
            $question,
            $recentChats
        );

        if (!$response['success'] && env('FALLBACK_TO_LOCAL_LLM')) {
            $fallbackResponse = $this->askOllama(
                $question,
                $recentChats
            );
            $fallbackResponse['provider'] = 'gemini → ollama';
            return $fallbackResponse;
        }

        return $response;
    }


    private function askGemini(string $question, Collection $recentChats): array
    {
        $provider = 'gemini';
        $model = env('GEMINI_MODEL');
        $key = env('GEMINI_API_KEY');

        if (env('GEMINI_SAMPLE_RESPONSE')) {
            return env('GEMINI_SAMPLE_RESPONSE_SUCCESS')
                ? $this->aiResponse(
                    true,
                    'Success msg from gemini sample',
                    'gemini sample',
                    $model
                )
                : $this->aiResponse(
                    false,
                    'Error msg from gemini sample',
                    'gemini sample',
                    $model
            );
        }

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
        $provider = 'ollama';
        $model = env('OLLAMA_MODEL');

        $context = $this->buildContext($recentChats);

        $fullPrompt = env('SYSTEM_PROMPT')
            . "\n\n"
            . $context
            . "\n\nActual User Message:\n"
            . $question
            . "\n\nAssistant:";

        $payload = [
            'model' => $model,
            'prompt' => $fullPrompt,
            'stream' => false
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => 'http://localhost:11434/api/generate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($payload)
        ]);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($response === false) {
            return $this->aiResponse(
                false,
                'Failed to connect to Ollama: ' . $curlError,
                $provider,
                $model
            );
        }

        $data = json_decode($response, true);

        if (isset($data['error'])) {
            return $this->aiResponse(
                false,
                $data['error'],
                $provider,
                $model
            );
        }

        if ($httpCode != 200) {
            return $this->aiResponse(
                false,
                $response,
                $provider,
                $model
            );
        }

        if (empty($data['response'])) {
            return $this->aiResponse(
                false,
                'Empty response from Ollama',
                $provider,
                $model
            );
        }

        return $this->aiResponse(
            true,
            $data['response'],
            $provider,
            $model
        );
    }


    private function aiResponse(bool $success, string $message, string $provider, string $model): array
    {

        if (!$success) {
            Log::channel($provider)->warning(
                "{$provider} request failed",
                [
                    'response' => $message
                ]
            );
        }

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