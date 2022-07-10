<?php

namespace App\Http\Controllers\Automations;

use App\Http\Controllers\Controller;
use App\OpenOverlay\Actions\Automation\UpdateAutomation;
use App\OpenOverlay\Automations\Settings\SettingsHandler;
use App\OpenOverlay\Helpers\Actions;
use App\OpenOverlay\Helpers\Filters;
use App\OpenOverlay\Helpers\Triggers;
use App\OpenOverlay\Models\Automation;
use App\OpenOverlay\Models\AutomationAction;
use App\OpenOverlay\Models\AutomationFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use function inertia;

class EditController extends Controller
{
    public function __invoke(Automation $automation)
    {
        return inertia('Automations/Edit', [
            'automation'      => $automation,
            'filters'         => $this->filterList($automation),
            'actions'         => $this->actionsList($automation),
            'triggersList'    => Triggers::selectList(),
            'actionsFormList' => Actions::cardList(),
            'filtersFormList' => Filters::cardList(),
        ]);
    }

    public function update(Request $request, Automation $automation, UpdateAutomation $updateAutomation)
    {
        $automation = $updateAutomation->execute($automation, $request->all());

        if (empty($automation)) {
            return redirect()->back()->withErrors(['error' => 'Automation could not be updated']);
        }

        return redirect()->back()->with(['success' => 'Automation updated']);
    }

    private function filterList(Automation $automation): Collection
    {
        return $automation->filters->map(function (AutomationFilter $filter) {
            /** @var SettingsHandler $formClass */
            $formClass = $filter->form_class;
            $name = empty($filter->name) ? $formClass::referenceName() : $filter->name;

            return [
                'id'          => $filter->id,
                'name'        => $name,
                'subtitle'    => $name !== $formClass::referenceName() ? $formClass::referenceName() : null,
                'description' => $formClass::referenceDescription(),
            ];
        });
    }

    private function actionsList(Automation $automation): Collection
    {
        return $automation->actions->map(function (AutomationAction $action) {
            /** @var SettingsHandler $formClass */
            $formClass = $action->form_class;
            $name = empty($action->name) ? $formClass::referenceName() : $action->name;

            return [
                'id'          => $action->id,
                'name'        => $name,
                'subtitle'    => $name !== $formClass::referenceName() ? $formClass::referenceName() : null,
                'description' => $formClass::referenceDescription(),
            ];
        });
    }
}
