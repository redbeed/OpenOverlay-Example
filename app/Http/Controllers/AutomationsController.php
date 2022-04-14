<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Redbeed\OpenOverlay\Automations\AutomationDispatcher;
use Redbeed\OpenOverlay\Automations\AutomationHandler;
use Redbeed\OpenOverlay\Automations\Triggers\Trigger;

class AutomationsController extends Controller
{
    public function __invoke()
    {
        /** @var Trigger[] $automations */
        $automations = collect(app('automations')->getAutomations())
            ->filter(function ($automations) {
                return !empty($automations);
            })
            ->mapWithKeys(function ($automations, $triggerClass) {
                return [
                    $triggerClass => [
                        'name'        => $triggerClass::$name,
                        'description' => $triggerClass::$description,
                        'automations' => collect($automations)->map(function ($automation) {
                            return $this->parseAutomation($automation);
                        }),
                    ]
                ];
            });

        return inertia('Automations/List', [
            'automations' => $automations,
        ]);
    }

    private function parseAutomation(string $automationClass): Collection {
        $automation = (new \ReflectionClass($automationClass))->newInstanceWithoutConstructor();

        return collect([
            'name'        => $automation::$name,
            'description' => $automation::$description,
            'filters'     => count($automation->filters()),
            'actions'     => count($automation->actions()),
        ]);
    }
}
