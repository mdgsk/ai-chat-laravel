<?php

return [

    'paginate_chat' => env('PAGINATE_CHAT', 20),
    'paginate_conversation' => env('PAGINATE_CONVERSATION', 10),
    'context_messages' => env('AI_CONTEXT_MESSAGES', 5),

    'gemini_api_key' => env('GEMINI_API_KEY'),
    'gemini_model' => env('GEMINI_MODEL'),
    'ollama_model' => env('OLLAMA_MODEL'),

    'use_local_llm' => env('USE_LOCAL_LLM'),
    'gemini_sample_response' => env('GEMINI_SAMPLE_RESPONSE'),
    'gemini_sample_response_success' => env('GEMINI_SAMPLE_RESPONSE_SUCCESS'),
    'fallback_to_local_llm' => env('FALLBACK_TO_LOCAL_LLM'),

    'system_prompt' => env('SYSTEM_PROMPT'),
    'prompt' => env('AI_PROMPT', 'default'),


];