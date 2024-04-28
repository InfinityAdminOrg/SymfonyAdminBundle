<?php

namespace Infinity\Tool\DependencyInjection\CompilerPass;

use Infinity\Action\Attribute\AsAction;
use Infinity\Action\Service\Listing as ActionListing;
use Infinity\Tool\Service\Listing as ToolListing;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ToolAndActionGatheringCompilerPass implements CompilerPassInterface
{
    public function process(
        ContainerBuilder $container
    ): void {
        if (!$container->hasDefinition(ToolListing::class)
            || !$container->hasDefinition(ActionListing::class)) {
            return;
        }

        $toolListing = $container->getDefinition(ToolListing::class);
        $actionListing = $container->getDefinition(ActionListing::class);

        /** @var array<string, Reference> $services */
        $services = [];
        /** @var array<string, array<string, array{0: string, 1?: string, 2?: string}>> $actions */
        $actions = [];

        foreach ($container->findTaggedServiceIds('infinity.tool') as $id => $attr) {
            $definition = $container->getDefinition($id);

            try {
                $reflection = new \ReflectionClass($definition->getClass());
            } catch (\ReflectionException) {
                continue;
            }

            $currentActions = [];

            foreach ($reflection->getMethods() as $method) {
                // only one action is allowed per method anyway so we don't need to iterate
                if (null === ($attribute = $method->getAttributes(AsAction::class)[0] ?? null)) {
                    continue;
                }

                /** @var AsAction $instance */
                $instance = $attribute->newInstance();
                $currentActions[$method->getName()] = [
                    $instance->title,
                ];

                if (null !== $instance->description) {
                    $currentActions[$method->getName()][1] = $instance->description;
                }

                if (null !== $instance->translationDomain) {
                    $currentActions[$method->getName()][2] = $instance->translationDomain;
                }
            }

            // Don't register a tool if it has no action - no point
            if (empty($currentActions)) {
                continue;
            }

            $services[$id] = new Reference($id);
            $actions[$id] = $currentActions;
        }

        $toolListing->setArgument('$services', $services);
        $actionListing->setArgument('$actions', $actions);
    }
}
