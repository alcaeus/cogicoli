<?php

declare(strict_types = 1);

namespace Alcaeus\Cogicoli\Contributor;

final class Contributor implements ContributorInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $contributions;

    public function __construct(string $name, int $contributions = 0)
    {
        $this->name = $name;
        $this->contributions = $contributions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContributions(): int
    {
        return $this->contributions;
    }

    public function merge(ContributorInterface $contributor): ContributorInterface
    {
        return new self(
            $this->getName(),
            $contributor->getContributions() + $this->getContributions()
        );
    }
}
