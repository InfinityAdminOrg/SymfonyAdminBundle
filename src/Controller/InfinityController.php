<?php

namespace InfinityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class InfinityController extends AbstractController
{
    #[Route('/{params}', name: 'infinity.clear.opa', requirements: ['params' => '.+'], defaults: ['params' => ''], methods: ['GET', 'POST', 'DELETE', 'PATCH'], priority: -1)]
    public function opa(
        Request $request,
        RouterInterface $router
    ): Response {
        $isHmtx = 'true' === $request->headers->get('hx-request');
        dump($isHmtx, $request->getUser());

        if ($isHmtx && null === $request->getUser()) {
            return $this->render('@Infinity/login.html.twig');
        }

        return $this->render('@Infinity/base.html.twig', [
            'base_url' => $router->generate('infinity.clear.opa', ['params' => '']),
        ]);
    }

    #[Route('/login', name: 'infinity.clear.login', methods: ['POST'])]
    public function login(
        AuthenticationUtils $utils
    ): JsonResponse {
        return $this->json(['ok' => 'ok']);
    }
}
