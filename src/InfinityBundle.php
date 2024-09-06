<?php

namespace Infinity;

use Infinity\Context\Interface\ResolverInterface;
use Infinity\DependencyInjection\TaggingExtension;
use Infinity\Entity\DependencyInjection\ResourceCompilerPass;
use Infinity\Entity\Interface\ResourceInterface;
use Infinity\Field\Interface\FieldDescriberInterface;
use Infinity\Field\Interface\FieldHandlerInterface;
use Infinity\Renderer\Interface\RendererInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class InfinityBundle extends Bundle
{
    public const string ENTITY_RESOURCE_TAG = 'infinity.entity.resource';

    public const string FIELD_DESCRIBER_TAG = 'infinity.field.describer';
    public const string FIELD_HANDLER_TAG = 'infinity.field.handler';

    public const string CONTEXT_RESOLVER_TAG = 'infinity.context.resolver';

    public const string HTMX_RENDERER_TAG = 'infinity.htmx.renderer';

    public function build(
        ContainerBuilder $container
    ): void {
        $container->registerExtension(new TaggingExtension([
            ResourceInterface::class => self::ENTITY_RESOURCE_TAG,

            FieldDescriberInterface::class => self::FIELD_DESCRIBER_TAG,
            FieldHandlerInterface::class => self::FIELD_HANDLER_TAG,

            ResolverInterface::class => self::CONTEXT_RESOLVER_TAG,

            RendererInterface::class => self::HTMX_RENDERER_TAG,
        ]));

        $container->addCompilerPass(new ResourceCompilerPass());
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
