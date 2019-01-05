<?php

declare(strict_types = 1);

namespace Alcaeus\Cogicoli\Contributor;

interface ContributorInterface
{
    /**
     * Returns the username for the contributor
     */
    public function getName(): string;

    /**
     * Returns the number of contributions, or 0 if this number is not reported
     */
    public function getContributions(): int;

    /**
     * Returns a new contributor object having contributions merged
     */
    public function merge(ContributorInterface $contributor): ContributorInterface;
}
