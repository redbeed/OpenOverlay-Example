<?php

namespace App\Http\Controllers\Automations\Action;

use App\Http\Controllers\Controller;
use App\OpenOverlay\Actions\Action\UpdateAction;
use App\OpenOverlay\Models\Automation;
use App\OpenOverlay\Models\AutomationAction;
use Illuminate\Http\Request;

class EditActionController extends Controller
{
    public function __invoke(Automation $automation, AutomationAction $action)
    {
        return inertia('Automations/EditAction', [
            'automation'      => $automation,
            'action'          => $action,
            'settingsHandler' => (new $action->form_class)->prepare($action->settings ?? []),
        ]);
    }

    public function update(Automation $automation, AutomationAction $action, UpdateAction $updateAction, Request $request)
    {
        $action = $updateAction->execute($action, (new $action->form_class), $request->all());

        if ($action) {
            return redirect()->route('automations.edit', [$automation])
                ->with('success', 'Filter updated successfully.');
        }

        return redirect()->route('automations.action.edit', [$automation, $action])
            ->with('error', 'There was an error updating the action.');
    }
}
