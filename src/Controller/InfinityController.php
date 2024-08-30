<?php

namespace Infinity\Controller;

use Infinity\Renderer\HtmxRenderer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class InfinityController extends AbstractController
{
    #[Route('/{params}', name: 'infinity.clear.opa', requirements: ['params' => '.+'], defaults: ['params' => ''], methods: ['GET', 'POST', 'DELETE', 'PATCH'], priority: -1)]
    public function opa(
        Request $request,
        HtmxRenderer $renderer
    ): Response {
        return $renderer->render($request);
    }

    #[Route('/login', name: 'infinity.clear.login', methods: ['GET', 'POST'])]
    public function login(
        #[CurrentUser] UserInterface|null $user,
        AuthenticationUtils $utils
    ): Response {
        if (null !== $user) {
            return $this->redirectToRoute('infinity.clear.opa');
        }

        return $this->render('@InfinityBundle/login.html.twig');
    }
}
