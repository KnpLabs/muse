<?php

namespace Muse;

use Muse\Loader\FileLoader;
use Muse\Generator\JsonSchemaV4Generator;
use Muse\Generator\FakeDataProvider\Dumb;
use Muse\Generator\FakeDataProvider\Random;

class MuseFactory
{
    public static function createDumbMuse()
    {
        return new Muse(new FileLoader(), new JsonSchemaV4Generator(new Dumb()));
    }

    public static function createRandomMuse()
    {
        return new Muse(new FileLoader(), new JsonSchemaV4Generator(new Random()));
    }
}
