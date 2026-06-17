<?php

namespace App\Services;

use App\Contracts\AiProviderInterface;


class GeminiService implements AiProviderInterface
{
    public function generate(string $prompt): array
    {

        // sample response start
        if (config('ai.gemini_sample_response')) {
            if(config('ai.gemini_sample_response_success')) {
                return [
                    'success' => true,
                    'message' => 'Success msg from gemini sample',
                    'provider' => 'gemini sample',
                    'model' => 'hardcoded model',
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Error msg from gemini sample',
                    'provider' => 'gemini sample',
                    'model' => 'hardcoded model',
                ];
            }
        }
        // sample response start
        

        $provider = 'gemini';
        $model = config('ai.gemini_model');
        $key = config('ai.gemini_api_key');

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/'
            . $model
            . ':generateContent?key='
            . $key;

        $payload = [
            'contents' => [[
                'parts' => [[
                    'text' => $prompt
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
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            return [
                'success' => false,
                'message' => $curlError,
                'provider' => $provider,
                'model' => $model,
            ];
        }

        $data = json_decode($response, true);
        if (isset($data['error'])) {
            return [
                'success' => false,
                'message' => $data['error']['message'],
                'provider' => $provider,
                'model' => $model,
            ];
        }

        return [
            'success' => true,
            'message' => $data['candidates'][0]['content']['parts'][0]['text'] ?? '',
            'provider' => $provider,
            'model' => $model,
        ];
    }

}