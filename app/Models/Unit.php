<?php

namespace App\Models;

class Unit
{
    private string $code;
    private string $name;

    public function __construct(string $code, string $name)
    {
        $this->code = $code;
        $this->name = $name;
    }
}
