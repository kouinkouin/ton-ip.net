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

        if ($this->userAgentParser->isCliUserAgent($request->headers->get('User-Agent'))) {
            $response = new Response(array_shift($remoteIps));
            $response->headers->set('content-type', 'text/plain');

            return $response;
        }

        return $this->render("index.html.twig", ['remoteIps' => $remoteIps]);
    }
}
