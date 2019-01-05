<?php

namespace spec\Alcaeus\Cogicoli\Contributor;

use Alcaeus\Cogicoli\Contributor\Contributor;
use Alcaeus\Cogicoli\Contributor\ContributorList;
use PhpSpec\ObjectBehavior;

class ContributorListSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ContributorList::class);
    }

    function it_is_countable()
    {
        $this->beConstructedWith(...$this->getContributors());

        $this->shouldImplement(\Countable::class);
        $this->shouldHaveCount(3);
    }

    function it_is_iterable()
    {
        $this->shouldImplement(\Iterator::class);
    }

    private function getContributors()
    {
        return [
            new Contributor('a', 3),
            new Contributor('b', 4),
            new Contributor('c', 9),
        ];
    }
}
