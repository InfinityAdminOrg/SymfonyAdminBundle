<?php

use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->private();

    $services->set(\Infinity\Controller\InfinityController::class)
        ->tag('container.service_subscriber')
        ->tag('controller.service_arguments')
        ->autowire();

    $services->set(\Infinity\Navigation\Router::class)
        ->autowire();

    $services->set(\Infinity\Navigation\Navigator::class)
        ->autowire();

    $services->set(\Infinity\Renderer\ResourceRenderer::class)
        ->autowire()
        ->tag(\Infinity\InfinityBundle::HTMX_RENDERER_TAG);

    $services->set(\Infinity\Renderer\DashboardRenderer::class)
        ->autowire()
        ->tag(\Infinity\InfinityBundle::HTMX_RENDERER_TAG);

    $services->set(\Infinity\Renderer\Partial\SidebarRenderer::class)
        ->autowire()
        ->tag(\Infinity\InfinityBundle::HTMX_PARTIAL_RENDERER_TAG);

    $services->set(\Infinity\Renderer\Partial\BreadcrumbRenderer::class)
        ->autowire()
        ->tag(\Infinity\InfinityBundle::HTMX_PARTIAL_RENDERER_TAG);

    $services->set(\Infinity\Renderer\Partial\TitleRenderer::class)
        ->autowire()
        ->tag(\Infinity\InfinityBundle::HTMX_PARTIAL_RENDERER_TAG);

    $services->set(\Infinity\Renderer\HtmxRenderer::class)
        ->autowire()
        ->arg(0, new TaggedIteratorArgument(\Infinity\InfinityBundle::HTMX_PARTIAL_RENDERER_TAG));

    $services->set(\Infinity\Responder\Responder::class)
        ->arg(0, new TaggedIteratorArgument(\Infinity\InfinityBundle::HTMX_RENDERER_TAG))
        ->autowire();

    $services->set(\Infinity\Entity\ResourceCollector::class);

    $services->set(\Infinity\Context\Resolver\ResourceResolver::class)
        ->tag(\Infinity\InfinityBundle::CONTEXT_RESOLVER_TAG);

    $services->set(\Infinity\Context\Creator::class)
        ->autowire()
        ->arg(0, new TaggedIteratorArgument(\Infinity\InfinityBundle::CONTEXT_RESOLVER_TAG));

    $services->set(\Infinity\Twig\UidExtension::class)
        ->tag('twig.extension');

    $services->set(\Infinity\Twig\MiscExtension::class)
        ->autowire()
        ->tag('twig.extension');
};
