<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    /**
     * @param string $userAgent
     * @param array  $expectedHeaders
     *
     * @dataProvider dataIndexAction
     */
    public function testIndexAction(?string $userAgent, array $expectedHeaders)
    {
        $client = self::createClient();
        $client->request('GET', '/', [], [], ['HTTP_USER_AGENT' => $userAgent]);

        $this->assertTrue($client->getResponse()->isSuccessful());

        foreach ($expectedHeaders as $key => $value) {
            $this->assertSame($value, $client->getResponse()->headers->get($key));
        }
    }

    public function dataIndexAction(): \Generator
    {
        yield [
            'Mozilla/5.0 (X11; Linux x86_64; rv:59.0) Gecko/20100101 Firefox/59.0',
            ['content-type' => 'application/json'],
        ];
        yield ['curl/7.52.1', ['content-type' => 'text/plain; charset=UTF-8']];
        yield ['Wget/1.18', ['content-type' => 'text/plain; charset=UTF-8']];
        yield [null, ['content-type' => 'text/plain; charset=UTF-8']];
    }
}
