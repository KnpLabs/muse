<?php

namespace spec\Muse\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Muse\Generator\FakeDataProvider;

class JsonSchemaV4GeneratorSpec extends ObjectBehavior
{
    function let(FakeDataProvider $provider)
    {
        $this->beConstructedWith($provider);
    }

    function it_creates_fake_string_for_string_property($provider)
    {
        $schema = [
            'properties' => [
                'name' => [
                    'type' => 'string',
                ],
            ],
        ];

        $provider->getString()->willReturn('random-name');

        $this->generate($schema)->shouldReturn(['name' => 'random-name']);
    }

    function it_creates_fake_integer_for_integer_property($provider)
    {
        $schema = [
            'properties' => [
                'id' => [
                    'type' => 'integer',
                ],
            ],
        ];

        $provider->getInteger()->willReturn(1337);

        $this->generate($schema)->shouldReturn(['id' => 1337]);
    }

    function it_creates_fake_boolean_for_boolean_property($provider)
    {
        $schema = [
            'properties' => [
                'active' => [
                    'type' => 'boolean',
                ],
            ],
        ];

        $provider->getBoolean()->willReturn(false);

        $this->generate($schema)->shouldReturn(['active' => false]);
    }

    function it_creates_fake_float_for_number_property($provider)
    {
        $schema = [
            'properties' => [
                'price' => [
                    'type' => 'number',
                ],
            ],
        ];

        $provider->getFloat()->willReturn(3.51);

        $this->generate($schema)->shouldReturn(['price' => 3.51]);
    }

    function it_creates_array_of_fake_data_for_array_property($provider)
    {
        $schema = [
            'properties' => [
                'tags' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => [
                                'type' => 'integer',
                            ],
                            'name' => [
                                'type' => 'string',
                            ],
                            'active' => [
                                'type' => 'boolean',
                            ],
                            'price' => [
                                'type' => 'number',
                            ],
                        ]
                    ]
                ],
            ],
        ];

        $provider->getInteger()->willReturn(1337);
        $provider->getString()->willReturn('random-name');
        $provider->getBoolean()->willReturn(false);
        $provider->getFloat()->willReturn(3.51);

        $this->generate($schema)->shouldReturn([
            'tags' => [
                [
                    'id' => 1337,
                    'name' => 'random-name',
                    'active' => false,
                    'price' => 3.51,
                ],
                [
                    'id' => 1337,
                    'name' => 'random-name',
                    'active' => false,
                    'price' => 3.51,
                ],
                [
                    'id' => 1337,
                    'name' => 'random-name',
                    'active' => false,
                    'price' => 3.51,
                ],
                [
                    'id' => 1337,
                    'name' => 'random-name',
                    'active' => false,
                    'price' => 3.51,
                ],
                [
                    'id' => 1337,
                    'name' => 'random-name',
                    'active' => false,
                    'price' => 3.51,
                ],
            ]
        ]);
    }

    function it_picks_a_fake_element_from_enum($provider)
    {
        $schema = [
            'properties' => [
                'type' => [
                    'enum' => ['foo', 'bar']
                ]
            ],
        ];

        $provider->getEnum(['foo', 'bar'])->willReturn('foo');

        $this->generate($schema)->shouldReturn(['type' => 'foo']);
    }
}
