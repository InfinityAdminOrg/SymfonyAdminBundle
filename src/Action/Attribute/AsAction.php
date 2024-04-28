<?php

namespace Infinity\Action\Attribute;

use Infinity\Tool\Attribute\AsTool;
use Symfony\Component\Translation\TranslatableMessage;

/**
 * Creates an action for Infinity.
 *
 * Actions can only be contained within Tools.
 *
 * @see AsTool
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
class AsAction
{
    public function __construct(
        public readonly TranslatableMessage|string $title,
        public readonly TranslatableMessage|string|null $description = null,
        public string|null $translationDomain = null
    ) {
    }
}
