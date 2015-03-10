<?php

namespace Muse\Generator;

use Muse\Generator;

class JsonSchemaV4Generator implements Generator
{
    protected $provider;

    public function __construct(FakeDataProvider $provider)
    {
        $this->provider = $provider;
    }

    public function generate(array $schema)
    {
        $data = [];
        foreach ($schema['properties'] as $property => $definition) {
            $data[$property] = $this->getRandomData($definition);
        }

        return $data;
    }

    private function getRandomData($definition)
    {
        if (isset($definition['enum'])) {
            return $this->provider->getEnum($definition['enum']);
        }

        switch ($definition['type']) {
            case 'string':
                return $this->provider->getString();

            case 'integer':
                return $this->provider->getInteger();

            case 'number':
                return $this->provider->getFloat();

            case 'boolean':
                return $this->provider->getBoolean();

            case 'array':
                $data = [];
                for ($i = 0; $i < 5; $i++) {
                    $data[] = $this->generate($definition['items']);
                }

                return $data;
        }
    }
}
