<?php

namespace Infinity\Tool\DependencyInjection\CompilerPass;

use Infinity\Action\Attribute\AsAction;
use Infinity\Tool\Model\Action;
use Infinity\Tool\Model\Service;
use Infinity\Tool\Service\Listing as ToolListing;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Translation\TranslatableMessage;

class ToolAndActionGatheringCompilerPass implements CompilerPassInterface
{
    public function process(
        ContainerBuilder $container
    ): void {
        if (!$container->hasDefinition(ToolListing::class)) {
            return;
        }

        // todo: maybe split this up a bit so it's easier to test

        $toolListing = $container->getDefinition(ToolListing::class);

        /** @var array<string, Reference> $services */
        $services = [];

        /** @var array<string, Definition> $definitions */
        $definitions = [];

        foreach ($container->findTaggedServiceIds('infinity.tool') as $id => $attr) {
            $definition = $container->getDefinition($id);

            try {
                $reflection = new \ReflectionClass($definition->getClass());
            } catch (\ReflectionException) {
                continue;
            }

            $currentActions = [];

            foreach ($reflection->getMethods() as $method) {
                // Only one action is allowed per method anyway so we don't need to iterate
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

            $startId = '.infinity.internal.'.$id;

            // Create required model instances
            // Action models
            /** @var array<string, Reference> $actions */
            $actions = [];

            foreach ($currentActions as $method => $data) {
                // Generate translation messages for definitions

                $title = new Definition(TranslatableMessage::class, [
                    '$message' => $data[0],
                    '$domain' => $data[2] ?? null,
                ]);
                $title->setShared(false)
                    ->setPublic(false);

                $definitions[$titleId = $startId.'.message.title'] = $title;
                $descriptionId = null;

                if (null !== ($data[1] ?? null)) {
                    $description = new Definition(TranslatableMessage::class, [
                        '$message' => $data[1],
                        '$domain' => $data[2] ?? null,
                    ]);
                    $description->setShared(false)
                        ->setPublic(false);

                    $definitions[$descriptionId = $startId.'.message.description'] = $description;
                }

                $action = new Definition(Action::class, [
                    '$method' => $method,
                    '$title' => new Reference($titleId),
                    '$description' => null === $descriptionId ? null : new Reference($descriptionId),
                ]);
                $action->setShared(false)
                    ->setPublic(false);

                $definitions[$actionId = $startId.'.action.'.$method] = $action;
                $actions[$method] = new Reference($actionId);
            }

            $service = new Definition(Service::class, [
                '$service' => new Reference($id),
                '$id' => $id,
                '$actions' => $actions,
            ]);
            $service->setShared(false)
                ->setPublic(false);

            $definitions[$serviceId = $startId.'.service'] = $service;
            $services[$id] = new Reference($serviceId);
        }

        $toolListing->setArgument('$services', $services);
        $container->addDefinitions($definitions);
    }
}
