<?php

namespace App\OpenOverlay\Actions\Action;

use App\OpenOverlay\Actions\Action;
use App\OpenOverlay\Automations\Settings\SettingsHandler;
use App\OpenOverlay\Models\AutomationAction;
use Illuminate\Support\Facades\Validator;

class UpdateAction implements Action
{
    public function execute(AutomationAction $action, SettingsHandler $handler, array $input): ?AutomationAction
    {
        Validator::make($input, $this->formRules($handler))->validate();

        return $this->updateAction($action, $handler, $input);
    }

    private function formRules(SettingsHandler $handler)
    {
        return array_merge_recursive(
            $handler->formRules(),
            [
                'name' => ['nullable', 'string', 'max:100'],
            ]
        );
    }

    private function updateAction(AutomationAction $action, SettingsHandler $handler, array $input): ?AutomationAction
    {
        $rules = $this->formRules($handler);
        $action->settings = collect($input)->only(array_keys($rules))->forget('name');

        $action->name = $input['name'] ?? '';

        return $action->save() ? $action : null;
    }
}
