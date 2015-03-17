<?php

namespace Muse\Generator\FakeDataProvider;

use Muse\Generator\FakeDataProvider;
use Faker\Generator;
use Faker\Factory;

class Faker implements FakeDataProvider
{
    public function __construct(Generator $faker = null)
    {
        $this->faker = $faker ?: Factory::create();
    }

    public function getInteger($minimum)
    {
        return $this->faker->randomDigit($minimum);
    }

    public function getFloat($minimum)
    {
        return $this->faker->randomFloat(2, $minimum);
    }

    public function getString($maxLength)
    {
        switch (true) {
            case $maxLength <= 10:
                return $this->faker->word;
            case $maxLength <= 100:
                return $this->faker->sentence;
            case $maxLength <= 255:
                return $this->faker->paragraph;
            case $maxLength > 255:
                return $this->faker->text($maxLength);
        }

        return $this->faker->sentence;
    }

    public function getBoolean()
    {
        return (mt_rand() & 1) === 0;
    }

    public function getEnum(array $enum)
    {
        if (count($enum) > 0) {
            return $enum[mt_rand(0, count($enum) - 1)];
        }
    }
}
