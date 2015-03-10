<?php

namespace spec\Muse\Generator\FakeDataProvider;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DumbSpec extends ObjectBehavior
{
    function it_is_a_fake_data_provider()
    {
        $this->shouldBeAnInstanceOf('Muse\Generator\FakeDataProvider');
    }

    function it_generate_some_integer()
    {
        $this->getInteger()->shouldBeInteger();
    }

    function it_generate_some_float()
    {
        $this->getFloat()->shouldBeFloat();
    }

    function it_generate_some_string()
    {
        $this->getString()->shouldBeString();
    }

    function it_generate_some_boolean()
    {
        $this->getBoolean()->shouldBeBoolean();
    }

    function it_picks_first_element_of_enum()
    {
        $this->getEnum(['foo', 'bar'])->shouldReturn('foo');
    }
}
