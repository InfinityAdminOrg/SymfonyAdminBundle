<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->private();

    $services->set(\InfinityBundle\Controller\InfinityController::class)
        ->tag('container.service_subscriber')
        ->tag('controller.service_arguments');

    $services->set(\InfinityBundle\Twig\UidExtension::class)
        ->tag('twig.extension');
};
