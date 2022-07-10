<?php

namespace App\Http\Controllers\Automations\Filter;

use App\Http\Controllers\Controller;
use App\OpenOverlay\Actions\Filter\UpdateFilter;
use App\OpenOverlay\Models\Automation;
use App\OpenOverlay\Models\AutomationFilter;
use Illuminate\Http\Request;

class EditFilterController extends Controller
{
    public function __invoke(Automation $automation, AutomationFilter $filter)
    {
        return inertia('Automations/EditFilter', [
            'automation'      => $automation,
            'filter'          => $filter,
            'settingsHandler' => (new $filter->form_class)->prepare($filter->settings ?? []),
        ]);
    }

    public function update(Automation $automation, AutomationFilter $filter, UpdateFilter $action, Request $request)
    {
        $filter = $action->execute($filter, (new $filter->form_class), $request->all());

        if ($filter) {
            return redirect()->route('automations.edit', [$automation])
                ->with('success', 'Filter updated successfully.');
        }

        return redirect()->route('automations.filters.edit', [$automation, $filter])
            ->with('error', 'There was an error updating the filter.');
    }
}
