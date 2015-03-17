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
            'type' => 'object',
            'properties' => [
                'name' => [
                    'type' => 'string',
                    'maxLength' => 1337
                ],
            ],
        ];

        $provider->getString(1337)->willReturn('random-name');

        $this->generate($schema)->shouldReturn(['name' => 'random-name']);
    }

    function it_creates_fake_integer_for_integer_property($provider)
    {
        $schema = [
            'type' => 'object',
            'properties' => [
                'id' => [
                    'type' => 'integer',
                    'minimum' => 4
                ],
            ],
        ];

        $provider->getInteger(4)->willReturn(1337);

        $this->generate($schema)->shouldReturn(['id' => 1337]);
    }

    function it_creates_fake_boolean_for_boolean_property($provider)
    {
        $schema = [
            'type' => 'object',
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
            'type' => 'object',
            'properties' => [
                'price' => [
                    'type' => 'number',
                    'minimum' => 12
                ],
            ],
        ];

        $provider->getFloat(12)->willReturn(3.51);

        $this->generate($schema)->shouldReturn(['price' => 3.51]);
    }

    function it_creates_array_of_fake_data_for_array_property($provider)
    {
        $schema = [
            'type' => 'object',
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

        $provider->getInteger(0)->willReturn(1337);
        $provider->getString(255)->willReturn('random-name');
        $provider->getBoolean()->willReturn(false);
        $provider->getFloat(0)->willReturn(3.51);

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

    function it_creates_collection_of_fake_items_for_array_type($provider)
    {
        $schema = [
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
        ];

        $provider->getInteger(0)->willReturn(1337);
        $provider->getString(255)->willReturn('random-name');
        $provider->getBoolean()->willReturn(false);
        $provider->getFloat(0)->willReturn(3.51);

        $this->generate($schema)->shouldReturn([
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
        ]);
    }

    function it_picks_a_fake_element_from_enum($provider)
    {
        $schema = [
            'type' => 'object',
            'properties' => [
                'type' => [
                    'enum' => ['foo', 'bar']
                ]
            ],
        ];

        $provider->getEnum(['foo', 'bar'])->willReturn('foo');

        $this->generate($schema)->shouldReturn(['type' => 'foo']);
    }

    function it_generate_values_with_default_parameters($provider)
    {
        $schema = [
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
        ];

        $provider->getInteger(0)->shouldBeCalled();
        $provider->getString(255)->shouldBeCalled();
        $provider->getBoolean()->shouldBeCalled();
        $provider->getFloat(0)->shouldBeCalled();

        $this->generate($schema);
    }
}
