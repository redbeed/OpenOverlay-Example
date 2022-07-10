<?php

namespace App\OpenOverlay\Actions\Filter;

use App\OpenOverlay\Actions\Action;
use App\OpenOverlay\Automations\Settings\SettingsHandler;
use App\OpenOverlay\Models\Automation;
use App\OpenOverlay\Models\AutomationFilter;
use Illuminate\Support\Facades\Validator;

class UpdateFilter implements Action
{
    public function execute(AutomationFilter $filter, SettingsHandler $handler, array $input): ?AutomationFilter
    {
        Validator::make($input, $this->formRules($handler))->validate();

        return $this->updateFilter($filter, $handler, $input);
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

    private function updateFilter(AutomationFilter $filter, SettingsHandler $handler, array $input): ?AutomationFilter
    {
        $rules = $this->formRules($handler);
        $filter->settings = collect($input)->only(array_keys($rules))->forget('name');

        $filter->name = $input['name'] ?? '';

        return $filter->save() ? $filter : null;
    }
}
