<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        $remoteIps = $request->getClientIps();

        $userAgent = strtolower($request->headers->get('User-Agent'));

        switch (true) {
            case strpos($userAgent, 'curl') === 0:
            case strpos($userAgent, 'wget') === 0:
                return new Response(array_shift($remoteIps));

            default:
                return $this->json($remoteIps);
        }
    }
}
