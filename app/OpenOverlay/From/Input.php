<?php

namespace App\OpenOverlay\From;

class Input extends FormElement implements \JsonSerializable
{
    public static string $type = 'input';

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->addRule('string');
    }

    public function getValue(): string
    {
        return (string) $this->value;
    }
}
