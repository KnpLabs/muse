<?php

namespace Muse\Generator;

interface FakeDataProvider
{
    public function getInteger();

    public function getFloat();

    public function getString();

    public function getBoolean();
}
