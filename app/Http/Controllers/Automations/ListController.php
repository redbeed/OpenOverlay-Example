<?php

namespace App\Http\Controllers\Automations;

use App\Http\Controllers\Controller;
use App\OpenOverlay\Helpers\Triggers;
use App\OpenOverlay\Models\Automation;
use Closure;
use function collect;
use function inertia;

class ListController extends Controller
{
    public function __invoke()
    {
        return inertia('Automations/List', [
            'automations' => $this->listAutomations(),
            'triggers'    => Triggers::selectList(),
        ]);
    }

    private function listAutomations()
    {
        $codeBased = collect(app('automations')->getAutomations())
            ->filter(function ($automations) {
                return ! empty($automations);
            })
            ->mapWithKeys(function ($automations, $triggerClass) {
                return [
                    $triggerClass                  => collect($automations)
                        ->filter((fn ($automation) => ! ($automation instanceof Closure)))
                        ->map(function ($automation) {
                            return $this->parseAutomation($automation);
                        }),
                ];
            })
            ->toArray();

        $automation = Automation::whereBelongsTo(auth()->user())->get()
            ->map(function (Automation $automation) {
                return [
                    'id'          => $automation->id,
                    'name'        => $automation->name,
                    'description' => $automation->description,
                    'filters'     => $automation->filters()->count(),
                    'actions'     => $automation->actions()->count(),
                    'trigger'     => $automation->trigger,
                    'editable'    => true,
                ];
            })
            ->groupBy('trigger')
            ->toArray();

        return collect($automation)
            ->mergeRecursive($codeBased)
            ->map(function ($automations, $triggerClass) {
                return [
                    'name'        => $triggerClass::$name,
                    'description' => $triggerClass::$description,
                    'automations' => collect($automations)
                        ->sortBy([
                            ['editable', 'desc'],
                            ['name', 'asc'],
                        ]),
                ];
            });
    }

    private function parseAutomation(string $automationClass): array
    {
        $automation = (new \ReflectionClass($automationClass))->newInstanceWithoutConstructor();

        return [
            'name'        => $automation::$name,
            'description' => $automation::$description,
            'filters'     => count($automation->filters()),
            'actions'     => count($automation->actions()),
            'editable'    => false,
        ];
    }

    private function parseDatabaseAutomation(Automation $automation): array
    {
        return [
            'name'        => $automation->name,
            'description' => $automation->description,
            'filters'     => $automation->filters()->count(),
            'actions'     => $automation->actions()->count(),
            'trigger'     => $automation->trigger,
            'editable'    => true,
        ];
    }
}
