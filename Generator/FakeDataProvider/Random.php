<?php

namespace Muse\Generator\FakeDataProvider;

use Muse\Generator\FakeDataProvider;

class Random implements FakeDataProvider
{
    public function getInteger($minimum)
    {
        return mt_rand();
    }

    public function getFloat($minimum)
    {
        return mt_rand() / mt_getrandmax() * 100;
    }

    public function getString($maxLength)
    {
        return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
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
