<?php

namespace Infinity\Controller;

use Infinity\Action\Service\Executor;
use Infinity\Tool\Service\Listing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class InfinityController extends AbstractController
{
    #[Route('/{params}', name: 'infinity.clear.opa', requirements: ['params' => '.+'], defaults: ['params' => ''], methods: ['GET'], priority: -1)]
    public function opa(
        RouterInterface $router
    ): Response {
        return $this->render('@Infinity/base.html.twig', [
            'base_url' => $router->generate('infinity.clear.opa', ['params' => '']),
        ]);
    }

    #[Route('/login', name: 'infinity.clear.login', methods: ['POST'])]
    public function login(
        TokenStorageInterface $storage
    ): JsonResponse {
        return $this->json(['ok' => 'ok']);
    }

    #[Route('/tools', name: 'infinity.tools', methods: ['GET'])]
    public function tools(
        Request $request,
        Listing $listing,
        TranslatorInterface $translator
    ): JsonResponse {
        $response = [];

        foreach ($listing->all() as $service) {
            $actions = [];

            foreach ($service->getActions() as $action) {
                $actions[$action->getMethod()] = [
                    $action->getTitle()->trans($translator, $request->getLocale()),
                    $action->getDescription()?->trans($translator, $request->getLocale()),
                ];
            }

            $response[$service->getId()] = $actions;
        }

        return $this->json($response);
    }

    #[Route('/api', name: 'infinity.api', methods: ['POST', 'GET', 'PATCH', 'DELETE'])]
    public function api(
        Request $request,
        Executor $executor
    ): JsonResponse {
        return $this->json($executor->execute($request, $request->attributes->get('inContext')));
    }
}
