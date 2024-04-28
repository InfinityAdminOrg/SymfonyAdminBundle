<?php

use Infinity\Context\EventSubscriber\ContextSubscriber;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->private();

    $services->set(\Infinity\Tool\Service\Listing::class);
    $services->set(\Infinity\Action\Service\Listing::class);

    $services->set(\Infinity\Action\Service\Executor::class)
        ->arg('$toolListing', \Infinity\Tool\Service\Listing::class)
        ->arg('$actionListing', \Infinity\Action\Service\Listing::class);

    $services->set(ContextSubscriber::class)
        ->tag('kernel.event_subscriber');

    $services->set(\Infinity\Tool\Controller\ToolController::class)
        ->tag('controller.service_arguments');
};
