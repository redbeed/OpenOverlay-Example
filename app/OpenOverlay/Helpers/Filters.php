<?php

namespace App\OpenOverlay\Helpers;

use Illuminate\Support\Collection;

class Filters
{
    public static function cardList(): Collection
    {
        return collect(config('openoverlay.ui.automations.filters', []))
            ->mapWithKeys(function ($filterFormClass) {
                return [
                    $filterFormClass => [
                        'name'        => $filterFormClass::referenceName(),
                        'description' => $filterFormClass::referenceDescription(),
                    ],
                ];
            });
    }
}
