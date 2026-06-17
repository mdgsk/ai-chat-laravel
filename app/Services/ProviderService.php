<?php

namespace App\Services;

use App\Contracts\AiProviderInterface;

class ProviderService
{
    public function __construct(
        private OllamaService $ollamaService,
        private GeminiService $geminiService
    ) {
    }

    public function get(string $provider): AiProviderInterface
    {
        return match ($provider) {
            'ollama' => $this->ollamaService,
            'gemini' => $this->geminiService,
            default => $this->geminiService,
        };
    }
}