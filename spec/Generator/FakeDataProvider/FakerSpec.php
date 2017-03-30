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

    function it_generates_some_integer()
    {
        $this->getInteger(1)->shouldBeInteger();
    }

    public function it_generates_some_integer_between_limits()
    {
        $this->getInteger(2, false, 4, false)->shouldReturnOneOf([2, 3, 4]);
        $this->getInteger(2, true, 4, false)->shouldReturnOneOf([3, 4]);
        $this->getInteger(2, false, 4, true)->shouldReturnOneOf([2, 3]);
        $this->getInteger(2, true, 4, true)->shouldReturn(3);
    }

    function it_generates_some_float()
    {
        $this->getFloat(0)->shouldBeFloat();
    }

    function it_generates_some_float_between_limits()
    {
        $this->getFloat(5, false, 7, false)->shouldBeLowerOrEqualTo(7);
        $this->getFloat(5, false, 7, false)->shouldBeUpperOrEqualTo(5);

        $this->getFloat(5, false, 7, true)->shouldBeLowerThan(7);
        $this->getFloat(5, false, 7, true)->shouldBeUpperOrEqualTo(5);

        $this->getFloat(5, true, 7, false)->shouldBeLowerOrEqualTo(7);
        $this->getFloat(5, true, 7, false)->shouldBeUpperThan(5);

        $this->getFloat(5, true, 7, true)->shouldBeLowerThan(7);
        $this->getFloat(5, true, 7, true)->shouldBeUpperThan(5);
    }

    function it_generates_some_string()
    {
        $this->getString(255)->shouldBeString();
    }

    function it_generates_some_string_following_a_regex()
    {
    }

    public function it_geterates_a_string_with_limit_lengths()
    {
        $this->getString(2, 5)->shouldNotBeShorterThan(2);
        $this->getString(2, 5)->shouldNotBeLongerThan(5);
    }

    function it_generates_some_boolean()
    {
        $this->getBoolean()->shouldBeBoolean();
    }

    function it_picks_first_element_of_enum()
    {
        $this->getEnum(['foo', 'bar'])->shouldReturnOneOf(['foo', 'bar']);
    }

    public function getMatchers()
    {
        return [
            'returnOneOf' => function ($subject, $key) {
                return false !== array_search($subject, $key);
            },
            'beShorterThan' => function ($string, $max) {
                return strlen($string) < $max;
            },
            'beLongerThan' => function ($string, $min) {
                return strlen($string) > $min;
            },
            'beLowerThan' => function ($num, $max) {
                return $num < $max;
            },
            'beUpperThan' => function ($num, $min) {
                return $num > $min;
            },
            'beLowerOrEqualTo' => function ($num, $max) {
                return $num <= $max;
            },
            'beUpperOrEqualTo' => function ($num, $min) {
                return $num >= $min;
            },
        ];
    }
}
