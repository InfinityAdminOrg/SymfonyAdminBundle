<?php

namespace Infinity\Controller;

use Infinity\Responder\Responder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class InfinityController extends AbstractController
{
    #[Route('/{params}', name: 'infinity.opa', requirements: ['params' => '.+'], defaults: ['params' => ''], methods: ['GET', 'POST', 'DELETE', 'PATCH'], priority: -1)]
    public function opa(
        Request $request,
        Responder $responder
    ): Response {
        return $responder->responder($request);
    }

    #[Route('/login', name: 'infinity.login', methods: ['GET', 'POST'])]
    public function login(
        #[CurrentUser] UserInterface|null $user,
        AuthenticationUtils $utils
    ): Response {
        if (null !== $user) {
            return $this->redirectToRoute('infinity.opa');
        }

        return $this->render('@InfinityBundle/login.html.twig');
    }

    #[Route('/logout', name: 'infinity.logout', methods: ['GET'])]
    public function logout(): never
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
