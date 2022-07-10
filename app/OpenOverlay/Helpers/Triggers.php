<?php

namespace App\OpenOverlay\Helpers;

use Illuminate\Support\Collection;

class Triggers
{
    public static function selectList(): Collection
    {
        return collect(config('openoverlay.ui.automations.triggers', []))
            ->mapWithKeys(fn ($triggerClass) => [
                $triggerClass => $triggerClass::$name,
            ]);
    }
}
