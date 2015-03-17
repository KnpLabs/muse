<?php

namespace Muse\Generator;

use Muse\Generator;

class JsonSchemaV4Generator implements Generator
{
    protected $provider;

    protected $options = [
        'maxLength' => 255,
        'minLength' => 5,
        'minimum'   => 0,
    ];

    public function __construct(FakeDataProvider $provider)
    {
        $this->provider = $provider;
    }

    public function generate(array $schema)
    {
        if ('object' !== $schema['type']) {
            return $this->getRandomData($schema);
        }

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

        $type = $definition['type'];
        unset($definition['type']);

        $options = array_replace($this->options, $definition);

        switch ($type) {
            case 'string':
                return $this->provider->getString($options['maxLength']);

            case 'integer':
                return $this->provider->getInteger($options['minimum']);

            case 'number':
                return $this->provider->getFloat($options['minimum']);

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
