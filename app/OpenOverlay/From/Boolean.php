<?php

namespace App\OpenOverlay\From;

class Boolean extends FormElement implements \JsonSerializable
{

    public static string $type = 'checkbox';

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->addRule('boolean');
        $this->addRule('nullable');
    }

    public function getValue(): bool
    {
        return (bool)$this->value;
    }
}
