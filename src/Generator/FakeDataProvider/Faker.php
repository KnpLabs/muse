<?php

namespace Muse\Generator\FakeDataProvider;

use Muse\Generator\FakeDataProvider;
use Faker\Generator;
use Faker\Factory;
use ReverseRegex\Lexer;
use ReverseRegex\Random\SimpleRandom;
use ReverseRegex\Parser;
use ReverseRegex\Generator\Scope;
use DateTime;

class Faker implements FakeDataProvider
{
    /**
     * @var Faker\Generator
     */
    private $faker;

    public function __construct(Generator $faker = null)
    {
        $this->faker = $faker ?: Factory::create();
    }

    /**
     * {@inheritdoc}
     *
     * @TODO Apply the multipleOf to the result
     */
    public function getInteger($minimum = 0, $exclusiveMinimum = false, $maximum = 1000, $exclusiveMaximum = false, $multipleOf = 1)
    {
        $maximum = $maximum ?: $minimum * 10;

        if (true === $exclusiveMinimum && false === $exclusiveMaximum) {
            do {
                $result = $this->faker->numberBetween($minimum, $maximum);
            } while ($result === $minimum);

            return $result;
        }

        if (false === $exclusiveMinimum && true === $exclusiveMaximum) {
            do {
                $result = $this->faker->numberBetween($minimum, $maximum);
            } while ($result === $maximum);

            return $result;
        }

        if (true === $exclusiveMinimum && true === $exclusiveMaximum) {
            do {
                $result = $this->faker->numberBetween($minimum, $maximum);
            } while ($result === $minimum || $result === $maximum);

            return $result;
        }

        return $this->faker->numberBetween($minimum, $maximum);
    }

    /**
     * {@inheritdoc}
     */
    public function getFloat($minimum = 0, $exclusiveMinimum = false, $maximum = 1000, $exclusiveMaximum = false, $multipleOf = 1)
    {
        return floatval($this->getInteger($minimum, $exclusiveMinimum, $maximum, $exclusiveMaximum, $multipleOf));
    }

    /**
     * {@inheritdoc}
     */
    public function getString($minLength = 10, $maxLength = null, $pattern = null, $format = null)
    {
        switch ($format) {
            case 'date-time':
                return $this->faker->date(DateTime::RFC3339);
            case 'email':
                return $this->faker->email;
            case 'hostname':
                return $this->faker->domainName;
            case 'ipv4':
                return $this->faker->ipv4;
            case 'ipv6':
                return $this->faker->ipv6;
            case 'uri':
                return $this->faker->url;
        }

        if (null !== $pattern) {
            // @TODO Generate a string from a regex if possible
        }

        $maxLength = $maxLength ?: $minLength * 10;
        $result = '';

        do {
            $result .= $this->faker->sentence;
        } while (strlen($result) < $maxLength);

        return substr($result, 0, $this->faker->numberBetween($minLength, $maxLength));
    }

    /**
     * {@inheritdoc}
     */
    public function getBoolean()
    {
        return $this->faker->boolean;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnum(array $enum)
    {
        if (count($enum) > 0) {
            return $this->faker->randomElement($enum);
        }
    }
}
