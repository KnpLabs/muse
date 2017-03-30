<?php

namespace Muse\Generator\FakeDataProvider;

use Muse\Generator\FakeDataProvider;

class Dumb implements FakeDataProvider
{
    /**
     * {@inheritdoc}
     */
    public function getInteger($minimum = 0, $exclusiveMinimum = false, $maximum = 1000, $exclusiveMaximum = false, $multipleOf = 1)
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function getFloat($minimum = 0, $exclusiveMinimum = false, $maximum = 1000, $exclusiveMaximum = false, $multipleOf = 1)
    {
        return 1.0;
    }

    /**
     * {@inheritdoc}
     */
    public function getString($minLength = 10, $maxLength = 100, $pattern = null, $format = null)
    {
        return str_pad('foo', 10);
    }

    /**
     * {@inheritdoc}
     */
    public function getBoolean()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnum(array $enum)
    {
        if (0 < count($enum)) {
            return current($enum);
        }
    }
}
