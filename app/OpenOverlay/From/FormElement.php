<?php

namespace App\OpenOverlay\From;

use JetBrains\PhpStorm\ArrayShape;

class FormElement implements \JsonSerializable
{
    public static string $type = 'hidden';

    public string $name;
    protected mixed $value = null;
    protected ?string $label = null;
    protected ?string $placeholder = null;

    public array $rules = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    public function getId(): string
    {
        return \Str::snake($this->name);
    }

    public function setValue(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setPlaceholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): string
    {
        return empty($this->label) ? ucfirst($this->name) : $this->label;
    }

    public function addRule(string $rule): static
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function required(): static
    {
        return $this->addRule('required');
    }

    public function optional(): static
    {
        return $this->addRule('nullable');
    }

    public function jsonSerialize(): array
    {
        return [
            'id'          => $this->getId(),
            'type'        => static::$type,
            'value'       => $this->value,
            'label'       => $this->getLabel(),
            'placeholder' => $this->placeholder,
            'rules'       => $this->rules,
        ];
    }
}
