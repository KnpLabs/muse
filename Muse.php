<?php

namespace Muse;

class Muse
{
    protected $loader;
    protected $generator;

    public function __construct(Loader $loader, Generator $generator)
    {
        $this->loader = $loader;
        $this->generator = $generator;
    }

    public function inspire($resource)
    {
        $data = $this->loader->load($resource);
        $data = $this->generator->generate(
            json_decode($data, true)
        );

        return json_encode($data);
    }
}
