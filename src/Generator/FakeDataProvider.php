<?php

namespace Muse\Generator;

interface FakeDataProvider
{
    public function getInteger($minimum = 0, $exclusiveMinimum = false, $maximum = 1000, $exclusiveMaximum = false, $multipleOf = 1);

    public function getFloat($minimum = 0, $exclusiveMinimum = false, $maximum = 1000, $exclusiveMaximum = false, $multipleOf = 1);

    public function getString($minLength = 10, $maxLength = 100, $pattern = null, $format = null);

    public function getBoolean();

    public function getEnum(array $enum);
}
