<?php

namespace spec\Muse;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Muse\Generator;

class MuseSpec extends ObjectBehavior
{
    function let(Generator $generator)
    {
        $this->beConstructedWith($generator);
    }

    function it_inspires_json_data($generator)
    {
        $generator->generate(['foo'])->willReturn(['json']);

        $this->inspire('["foo"]')->shouldReturn('["json"]');
    }

    function it_throws_exception_on_invalid_json_input()
    {
        $this->shouldThrow('Muse\Exception\InvalidArgumentException')->duringInspire('{');
    }
}
