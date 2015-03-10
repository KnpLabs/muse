<?php

namespace spec\Muse;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Muse\Loader;
use Muse\Generator;

class MuseSpec extends ObjectBehavior
{
    function let(Loader $loader, Generator $generator)
    {
        $this->beConstructedWith($loader, $generator);
    }

    function it_inspires_json_data($loader, $generator)
    {
        $loader->load('/path/to/json_schema')->willReturn('["json_schema"]');
        $generator->generate(['json_schema'])->willReturn(['json']);

        $this->inspire('/path/to/json_schema')->shouldReturn('["json"]');
    }
}
