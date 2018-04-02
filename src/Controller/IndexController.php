<?php

namespace App\Controller;

use App\Services\Request\UserAgentParser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @var UserAgentParser
     */
    private $userAgentParser;

    public function __construct(UserAgentParser $userAgentParser)
    {
        $this->userAgentParser = $userAgentParser;
    }

    public function indexAction(Request $request)
    {
        $remoteIps = $request->getClientIps();

        switch (true) {
            case $this->userAgentParser->isCliUserAgent($request->headers->get('User-Agent')):
                return new Response(array_shift($remoteIps));

            default:
                return $this->json($remoteIps);
        }
    }
}
