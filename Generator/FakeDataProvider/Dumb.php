<?php

namespace Muse\Generator\FakeDataProvider;

use Muse\Generator\FakeDataProvider;

class Dumb implements FakeDataProvider
{
    public function getInteger()
    {
        return 1;
    }

    public function getFloat()
    {
        return 1.0;
    }

    public function getString()
    {
        return 'foo';
    }

    public function getBoolean()
    {
        return true;
    }

    public function getEnum(array $enum)
    {
        if (isset($enum[0])) {
            return $enum[0];
        }
    }
}
