<?php

namespace App\OpenOverlay\Automations\Settings;

use App\OpenOverlay\From\FormElement;
use JsonSerializable;
use Redbeed\OpenOverlay\Automations\Filters\Filter;

class SettingsHandler implements JsonSerializable
{
    /**
     * @var class-string<Filter>|class-string $filterClass
     */
    public static string $referenceObject = Filter::class;

    private ?array $preparedForm = null;

    /**
     * @return FormElement[]
     */
    public function form(): array
    {
        return [];
    }

    public function prepare(array $inputs): static
    {
        foreach ($this->form() as $key => $formElement) {
            if (!empty($inputs[$formElement->getId()])) {
                $formElement = $formElement->setValue($inputs[$formElement->getId()]);
            }

            $this->preparedForm[$key] = $formElement;
        }

        return $this;
    }

    public function model(): Filter
    {
        return new static::$referenceObject();
    }

    public static function referenceName(): string
    {
        return static::$referenceObject::$name;
    }

    public static function referenceDescription(): string
    {
        return static::$referenceObject::$description;
    }

    public function formRules(): array
    {
        $rules = [];
        foreach ($this->form() as $formElement) {
            $rules[$formElement->getId()] = $formElement->rules;
        }

        return $rules;
    }

    public function jsonSerialize()
    {
        return [
            'name'        => $this->referenceName(),
            'description' => $this->referenceDescription(),
            'form'        => collect($this->preparedForm ?? $this->form())
                ->map(function (FormElement $formElement) {
                    return $formElement->jsonSerialize();
                })
                ->toArray()
        ];
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function buildObject(): object
    {
        $arguments = collect($this->preparedForm ?? $this->form())
            ->mapWithKeys(function (FormElement $formElement) {
                return [$formElement->name => $formElement->getValue()];
            })
            ->toArray();

        return app()->make(static::$referenceObject, $arguments);
    }
}
