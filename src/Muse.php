<?php

namespace Muse;

use Muse\Exception\InvalidArgumentException;

class Muse
{
    protected $loader;
    protected $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function inspire($resource)
    {
        $data = json_decode($resource, true);
        if (JSON_ERROR_NONE !== $lastError = json_last_error()) {
            throw new InvalidArgumentException($this->getLastJsonError($lastError));
        }

        if (!is_array($data)) {
            throw new InvalidArgumentException('JSON must contain an object');
        }

        return json_encode($this->generator->generate($data));
    }

    private function getLastJsonError($lastError)
    {
        switch ($lastError) {
            case JSON_ERROR_NONE:
                return 'No errors';
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded';
            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch';
            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found';
            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON';
            case JSON_ERROR_UTF8:
                return 'Malformed UTF-8 characters, possibly incorrectly encoded';
            default:
                return 'Unknown error';
        }
    }
}
