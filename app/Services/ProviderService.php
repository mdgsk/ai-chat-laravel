<?php

namespace App\Services;

use App\Contracts\AiProviderInterface;

class ProviderService
{

    public const GEMINI = 'gemini';
    public const OLLAMA = 'ollama';

    public function __construct(
        private OllamaService $ollamaService,
        private GeminiService $geminiService
    ) {
    }

    public function get(string $provider): AiProviderInterface
    {
        return match ($provider) {
            self::OLLAMA => $this->ollamaService,
            self::GEMINI => $this->geminiService,
            default => throw new \InvalidArgumentException(
                "Unsupported provider: {$provider}"
            ),
        };
    }

    public function defaultProvider(): AiProviderInterface
    {
        if (config('ai.use_local_llm')) {
            return $this->ollamaService;
        }
        return $this->geminiService;
    }

    public function fallbackProvider(): AiProviderInterface
    {
        return $this->ollamaService;
    }

    public function shouldFallback(array $response): bool
    {
        return !$response['success']
            && config('ai.fallback_to_local_llm');
    }

    public function fallbackChain(string $fromProvider, string $toProvider): string
    {
        return "{$fromProvider} → {$toProvider}";
    }





}