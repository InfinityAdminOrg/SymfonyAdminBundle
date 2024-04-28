<?php

use Infinity\Context\EventSubscriber\ContextSubscriber;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->private();

    $services->set(ContextSubscriber::class)
        ->tag('kernel.event_subscriber');
};
