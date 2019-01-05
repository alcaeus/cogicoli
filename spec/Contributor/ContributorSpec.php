<?php

namespace spec\Alcaeus\Cogicoli\Contributor;

use Alcaeus\Cogicoli\Contributor\Contributor;
use Alcaeus\Cogicoli\Contributor\ContributorInterface;
use PhpSpec\ObjectBehavior;

class ContributorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('name');
        $this->shouldHaveType(Contributor::class);
    }

    function it_implements_interface()
    {
        $this->beConstructedWith('name');
        $this->shouldImplement(ContributorInterface::class);
    }

    function it_stores_data()
    {
        $this->beConstructedWith('name', 45);
        $this->getName()->shouldBe('name');
        $this->getContributions()->shouldBe(45);
    }

    function it_is_mergeable()
    {
        $this->beConstructedWith('name', 37);
        $other = new Contributor('otherName', 45);

        $merged = $this->merge($other);

        $merged->shouldNotBeEqualTo($this);
        $merged->getName()->shouldBe('name');
        $merged->getContributions()->shouldBe(82);
    }
}
