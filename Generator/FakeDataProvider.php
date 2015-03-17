<?php

namespace Muse\Generator;

interface FakeDataProvider
{
    public function getInteger($minimum);

    public function getFloat($minimum);

    public function getString($maxLength);

    public function getBoolean();

    public function getEnum(array $enum);
}
