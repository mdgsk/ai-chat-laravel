<?php

namespace App\Services;

use League\CommonMark\CommonMarkConverter;

class MarkdownService
{
    public function render(string $markdown): string
    {
        $converter = new CommonMarkConverter();

        return $converter->convert($markdown)->getContent();
    }
}