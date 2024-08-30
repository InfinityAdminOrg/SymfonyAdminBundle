<?php

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

    $services->set(\Infinity\Renderer\HtmxRenderer::class)
        ->autowire();

    $services->set(\Infinity\Entity\ResourceCollector::class);

    $services->set(\Infinity\Twig\UidExtension::class)
        ->tag('twig.extension');

    $services->set(\Infinity\Twig\MiscExtension::class)
        ->autowire()
        ->tag('twig.extension');
};
