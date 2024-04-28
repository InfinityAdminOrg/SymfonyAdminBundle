<?php

namespace Infinity\Context\EventSubscriber;

use Infinity\Context\Service\Creator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ContextSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly Creator $creator
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onRequest',
        ];
    }

    public function onRequest(
        RequestEvent $event
    ): void {
        $request = $event->getRequest();

        if (!$event->isMainRequest() || 'infinity.api' !== $request->attributes->get('_route')) {
            return;
        }

        // todo: maybe catch this and show some error? unsure
        // todo: maybe store context in a service as well? (could just be accessed via RequestStack though)
        $context = $this->creator->__invoke($request);
        $request->attributes->set('inContext', $context);
    }
}
