<?php

use Infinity\Action\Service\Executor;
use Infinity\Context\EventSubscriber\ContextSubscriber;
use Infinity\Tool\Service\Listing;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->private();

    $services->set(Listing::class);

    $services->set(Executor::class)
        ->arg('$listing', Listing::class);

    $services->set(ContextSubscriber::class)
        ->tag('kernel.event_subscriber');
};
