<?php

namespace Infinity\Entity\DependencyInjection;

use Infinity\Entity\Attribute\AsResource;
use Infinity\Entity\Model\Resource;
use Infinity\Entity\ResourceCollector;
use Infinity\InfinityBundle;
use Infinity\Navigation\Attribute\Action;
use Infinity\Navigation\Attribute\Group;
use Infinity\Shared\Attribute\WithRoles;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class ResourceCompilerPass implements CompilerPassInterface
{
    public function process(
        ContainerBuilder $container
    ): void {
        if (!$container->hasDefinition(ResourceCollector::class)) {
            return;
        }

        /** @var array<string, Definition> $definitions */
        $definitions = [];
        /** @var list<Reference> $resources */
        $resources = [];

        foreach ($container->findTaggedServiceIds(InfinityBundle::ENTITY_RESOURCE_TAG) as $id => $tags) {
            try {
                $reflection = new \ReflectionClass($container->getDefinition($id)->getClass());
            } catch (\ReflectionException) {
                continue;
            }

            if (null === ($instance = ($reflection->getAttributes(AsResource::class)[0] ?? null)?->newInstance())) {
                throw new \LogicException(sprintf(
                    'Attribute %s must be specified on resource %s',
                    AsResource::class,
                    $id
                ));
            }
            /** @var AsResource $instance */

            /** @var array<string, Action> $actions */
            $actions = [];

            foreach ($reflection->getAttributes() as $attribute) {
                $action = $attribute->newInstance();
                if (!($action instanceof Action)) {
                    continue;
                }

                /** @var Action $action */

                if (array_key_exists($action->identifier, $actions)) {
                    throw new \LogicException(sprintf(
                        'Action %s already exists for resource %s',
                        $action->identifier,
                        $id
                    ));
                }

                $actions[$action->identifier] = $action;
            }

            // reformat actions into usable definitions
            /** @var list<Reference> $finalActions */
            $finalActions = [];

            foreach ($actions as $identifier => $action) {
                $rolesId = null;

                if (null !== $action->roles) {
                    $definitions[$rolesId = $id.'.'.$identifier.'.role'] = new Definition(WithRoles::class, [
                        $action->roles->roles,
                    ]);
                }

                $definitions[$actionId = $id.'.'.$identifier.'.action'] = new Definition(Action::class, [
                    $identifier,
                    null === $rolesId ? null : new Reference($rolesId),
                    $action->excludeOn,
                    $action->displayOn,
                ]);
                $finalActions[] = new Reference($actionId);
            }

            $groupId = null;

            if (null !== ($group = ($reflection->getAttributes(Group::class)[0] ?? null)?->newInstance())) {
                /** @var Group $group */
                $definitions[$groupId = $id.'.group'] = new Definition(Group::class, [
                    $group->id,
                    $group->label,
                    $group->icon,
                ]);
            }

            $definitions[$resourceId = $id.'.resource'] = new Definition(Resource::class, [
                new Reference($id),
                $instance->entity,
                $id,
                $finalActions,
                null === $groupId ? null : new Reference($groupId),
            ]);
            $resources[] = new Reference($resourceId);
        }

        $container->addDefinitions($definitions);
        $container->getDefinition(ResourceCollector::class)->setArgument(0, $resources);
    }
}
