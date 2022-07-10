<?php

namespace App\OpenOverlay\Helpers;

use Illuminate\Support\Collection;

class Actions
{
    public static function cardList(): Collection
    {
        return collect(config('openoverlay.ui.automations.actions', []))
            ->mapWithKeys(function($actionFormClass){
                return [
                    $actionFormClass => [
                        'name'        => $actionFormClass::referenceName(),
                        'description' => $actionFormClass::referenceDescription(),
                    ],
                ];
            });
    }
}
