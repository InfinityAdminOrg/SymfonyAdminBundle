<?php

namespace Infinity;

use Infinity\DependencyInjection\TaggingExtension;
use Infinity\Entity\Interface\ResourceInterface;
use Infinity\Field\Interface\FieldDescriberInterface;
use Infinity\Field\Interface\FieldHandlerInterface;
use Infinity\Navigation\Interface\GroupInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class InfinityBundle extends Bundle
{
    public const string ENTITY_RESOURCE_TAG = 'infinity.entity.resource';
    public const string NAVIGATION_GROUP_TAG = 'infinity.navigation.group';

    public const string FIELD_DESCRIBER_TAG = 'infinity.field.describer';
    public const string FIELD_HANDLER_TAG = 'infinity.field.handler';

    public function build(
        ContainerBuilder $container
    ): void {
        $container->registerExtension(new TaggingExtension([
            ResourceInterface::class => self::ENTITY_RESOURCE_TAG,
            GroupInterface::class => self::NAVIGATION_GROUP_TAG,

            FieldDescriberInterface::class => self::FIELD_DESCRIBER_TAG,
            FieldHandlerInterface::class => self::FIELD_HANDLER_TAG,
        ]));
    }

    public function getPath(): string
    {
        if (!isset($this->path)) {
            $reflected = new \ReflectionObject($this);
            /** @var string $filename */
            $filename = $reflected->getFileName();
            $this->path = \dirname($filename, 2); // modern bundle type
        }

        return $this->path;
    }
}
