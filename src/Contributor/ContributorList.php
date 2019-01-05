<?php

namespace Alcaeus\Cogicoli\Contributor;

final class ContributorList implements \Iterator, \Countable
{
    public const DUPLICATE_IGNORE = 0;

    public const DUPLICATE_MERGE = 1;

    /**
     * @var ContributorInterface[]
     */
    private $contributors = [];

    private $index = 0;

    public function __construct(ContributorInterface ...$contributors)
    {
        $this->contributors = array_combine(
            array_map(function (ContributorInterface $contributor) { return $contributor->getName(); }, $contributors),
            $contributors
        );
    }

    public function add(ContributorInterface $contributor, int $duplicateBehavior = self::DUPLICATE_IGNORE): void
    {
        $existingContributor = $this->getByName($contributor->getName());

        if (! $existingContributor) {
            $this->contributors[$contributor->getName()] = $contributor;
            return;
        }

        switch ($duplicateBehavior) {
            case self::DUPLICATE_IGNORE:
                break;

            case self::DUPLICATE_MERGE:
                $this->contributors[$contributor->getName()] = $contributor->merge($existingContributor);
                break;

            default:
                throw new \InvalidArgumentException('Invalid duplicateBehavior given');
        }
    }

    public function getByName(string $contributorName): ?ContributorInterface
    {
        return $this->contributors[$contributorName] ?? null;
    }

    public function merge(ContributorList $contributorList): void
    {
        foreach ($contributorList as $contributor)
        {
            $this->add($contributor, self::DUPLICATE_MERGE);
        }

        return;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->contributors);
    }

    /**
     * @return ContributorInterface
     */
    public function current()
    {
        return current($this->contributors);
    }

    public function next()
    {
        $this->index++;
        next($this->contributors);
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return current($this->contributors) !== false;
    }

    public function rewind()
    {
        $this->index = 0;
        reset($this->contributors);
    }
}
