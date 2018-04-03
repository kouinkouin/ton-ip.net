<?php

namespace App\Tests\Services\Request;

use App\Services\Request\UserAgentParser;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class UserAgentParserTest extends TestCase
{
    /**
     * @param string $userAgent
     * @param bool   $expected
     *
     * @dataProvider dataIsCliUserAgent
     */
    public function testIsCliUserAgent(string $userAgent, bool $expected)
    {
        $parser = new UserAgentParser();

        $this->assertSame($expected, $parser->isCliUserAgent($userAgent));
    }

    public function dataIsCliUserAgent(): \Generator
    {
        yield ['Mozilla/5.0 (X11; Linux x86_64; rv:59.0) Gecko/20100101 Firefox/59.0', false];
        yield ['curl/7.52.1', true];
        yield ['Wget/1.18', true];
    }
}
