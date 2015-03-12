# Muse
[![Build Status](https://travis-ci.org/KnpLabs/muse.svg)](https://travis-ci.org/KnpLabs/muse)

The Muse inspires itself from a [JSON Schema](http://json-schema.oirg/) (only wth JSON Schema v4 for now) to generate a valid JSON.

## Usage

``` php
$schema = <<<SCHEMA
{
  "type": "object",
  "properties": {
    "id": {
      "type": "integer"
    },
    "name": {
      "type": "string"
    }
  }
}
SCHEMA;


echo "Dumb data provider\n";
echo \Muse\MuseFactory::createDumbMuse()->inspire($schema);

echo "\n\n";
echo "Random data provider\n";
echo \Muse\MuseFactory::createRandomMuse()->inspire($schema);
```

will output:

```
Dumb data provider
{
    "id": 1,
    "name": "foo"
}

Random data provider
{
    "id": 1634388030,
    "name": "ajkvu5xpepkwwc04skkw4wgs0s4ok48"
}
```
