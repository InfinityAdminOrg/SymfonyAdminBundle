<?php

namespace Infinity\Action\Service;

use Infinity\Tool\Exception\InvalidServiceException;
use Symfony\Contracts\Translation\TranslatorInterface;

class Listing
{
    /**
     * @param array<string, array<string, array{0: string, 1?: string, 2?: string}>> $actions
     */
    public function __construct(
        private readonly array $actions,
        private readonly TranslatorInterface $translator
    ) {
    }

    /**
     * Returns a method -> [title, description (optional)] array of possible actions.
     *
     * @return array<string, array{0: string, 1?: string}>
     *
     * @throws InvalidServiceException
     */
    public function list(
        string $service
    ): array {
        return array_map(
            function (array $data) {
                $output = [
                    $this->translator->trans(
                        $data[0],
                        domain: $data[2] ?? null
                    ),
                ];

                if (array_key_exists(1, $data)) {
                    $output[] = $this->translator->trans(
                        $data[1],
                        domain: $data[2] ?? null
                    );
                }

                return $output;
            },
            $this->actions[$service] ?? throw new InvalidServiceException($service)
        );
    }

    public function isValidMethod(
        string $service,
        string $method
    ): bool {
        return null !== ($this->actions[$service][$method] ?? null);
    }
}
