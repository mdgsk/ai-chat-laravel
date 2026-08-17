<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

use App\Services\MessageBuilderService;

use App\Contracts\AiProviderInterface;
use App\Services\ProviderService;


class AiService
{
    
    private MessageBuilderService $messageBuilder;

    private ProviderService $providerService;


    public function __construct(
    MessageBuilderService $messageBuilder,
    ProviderService $providerService
    )
    {
        $this->messageBuilder = $messageBuilder;
        $this->providerService = $providerService;
    }


    public function ask(string $question, Collection $recentChats): array
    {

        $response = $this->askProvider(
            $question,
            $recentChats,
            $this->providerService->defaultProvider()
        );

        if ($this->providerService->shouldFallback($response)) {
            $fallbackResponse = $this->askProvider(
                $question,
                $recentChats,
                $this->providerService->fallbackProvider()
            );
            
            $fallbackResponse['provider'] = $this->providerService->fallbackChain(
                $response['provider'],
                $fallbackResponse['provider']
            );

            return $fallbackResponse;
        }

        return $response;
    }


    private function askProvider(string $question, Collection $recentChats, AiProviderInterface $providerService): array
    {

        $fullPrompt = $this->messageBuilder->buildPrompt(
            $question,
            $recentChats
        );

        $result = $providerService->generate(
            $fullPrompt
        );

        // log
        Log::channel('debugging')->info(
            "==================== " .
            "AI CHAT REQUEST " .
            "====================\n\n" .
            "QUESTION\n" .
            "----------------------------\n" .
            $question . "\n\n" .
            "CONTEXT COUNT: " . $recentChats->count() . "\n\n" .
            "PROMPT\n" .
            "---------------------------\n" .
            $fullPrompt . "\n" .
            "RESPONSE\n" .
            "----------------------------\n" .
            $result['message'] . "\n\n" .
            "PROVIDER: " . $result['provider'] . "\n" .
            "MODEL: " . $result['model'] . "\n\n\n\n\n"
        );


        return $this->aiResponse(
            $result['success'],
            $result['message'],
            $result['provider'],
            $result['model']
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

}