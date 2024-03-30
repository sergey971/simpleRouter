<?php

namespace kernel\Http;

class Request
{


    public function __construct(
        // readonly -> можем читать но изменять не сможем

        public readonly array $server,


    )
    {

    }

    public static function createFromGlobals(): static
    {
        return new static(
            $_SERVER,
        );
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function uri()
    {
        return strtok($this->server["REQUEST_URI"], "?");
    }
}