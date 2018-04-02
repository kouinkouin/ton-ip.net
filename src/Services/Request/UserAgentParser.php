<?php

namespace App\Services\Request;

class UserAgentParser
{
    public function isCliUserAgent(string $userAgent): bool
    {
        $userAgent = strtolower($userAgent);

        return strpos($userAgent, 'curl') === 0 || strpos($userAgent, 'wget') === 0;
    }
}
