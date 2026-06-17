<?php

namespace App\Services;

use App\Contracts\AiProviderInterface;


class OllamaService implements AiProviderInterface
{
    public function generate(string $prompt): array
    {
        $provider = 'ollama';
        $model = config('ai.ollama_model');

        $payload = [
            'model' => $model,
            'prompt' => $prompt,
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

        $data = json_decode($response, true);

        if ($response === false) {
            return [
                'success' => false,
                'message' => 'Failed to connect to Ollama: ' . $curlError,
                'provider' => $provider,
                'model' => $model,
            ];
        }

        if ($httpCode != 200) {
            return [
                'success' => false,
                'message' => $response,
                'provider' => $provider,
                'model' => $model,
            ];
        }

        if (isset($data['error'])) {
            return [
                'success' => false,
                'message' => $data['error'],
                'provider' => $provider,
                'model' => $model,
            ];
        }

        if (empty($data['response'])) {
            return [
                'success' => false,
                'message' => 'Empty response from Ollama',
                'provider' => $provider,
                'model' => $model,
            ];
        }

        return [
            'success' => true,
            'message' => $data['response'],
            'provider' => $provider,
            'model' => $model,
        ];

    }
}