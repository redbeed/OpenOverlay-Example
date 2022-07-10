<?php

namespace App\OpenOverlay\Actions\Action;

use App\OpenOverlay\Actions\Action;
use App\OpenOverlay\Models\Automation;
use App\OpenOverlay\Models\AutomationAction;
use Illuminate\Support\Facades\Validator;

class AddActionToAutomation implements Action
{
    public function execute(Automation $automation, array $input): AutomationAction
    {
        Validator::make($input, [
            'form_class' => ['required', 'string'],
            'name'       => ['nullable', 'string', 'max:100'],
        ])->validate();

        return $this->addFilter($automation, $input);
    }

    private function addFilter(Automation $automation, array $input): AutomationAction
    {
        return $automation->actions()->create([
            'name'       => $input['name'] ?? null,
            'form_class' => $input['form_class'],
        ]);
    }
}
