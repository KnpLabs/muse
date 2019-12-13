<?php

namespace spec\Muse\Generator\FakeDataProvider;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FakerSpec extends ObjectBehavior
{
    function it_is_a_fake_data_provider()
    {
        $this->shouldBeAnInstanceOf('Muse\Generator\FakeDataProvider');
    }

    function it_generate_some_integer()
    {
        $this->getInteger(1)->shouldBeInteger();
    }

    function it_generate_some_float()
    {
        $this->getFloat(0)->shouldBeFloat();
    }

    function it_generate_some_string()
    {
        $this->getString(255)->shouldBeString();
    }

    function it_generate_some_boolean()
    {
        $this->getBoolean()->shouldBeBoolean();
    }

    function it_picks_first_element_of_enum()
    {
        $this->getEnum(['foo', 'bar'])->shouldReturnOneOf(['foo', 'bar']);
    }

    public function getMatchers(): array
    {
        return [
            'returnOneOf' => function ($subject, $key) {
                return false !== array_search($subject, $key);
            },
        ];
    }
}
