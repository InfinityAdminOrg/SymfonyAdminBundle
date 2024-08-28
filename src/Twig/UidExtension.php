<?php

namespace InfinityBundle\Twig;

use Symfony\Component\Uid\Uuid;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class UidExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('uuid4', fn () => Uuid::v4()->toString()),
        ];
    }
}
