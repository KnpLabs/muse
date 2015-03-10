<?php

namespace Muse\Loader;

use Muse\Loader;

class FileLoader implements Loader
{
    public function load($resource)
    {
        return file_get_contents($resource);
    }
}
