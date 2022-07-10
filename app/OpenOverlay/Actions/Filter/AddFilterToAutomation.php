<?php

namespace App\OpenOverlay\Actions\Filter;

use App\OpenOverlay\Actions\Action;
use App\OpenOverlay\Models\Automation;
use App\OpenOverlay\Models\AutomationFilter;
use Illuminate\Support\Facades\Validator;

class AddFilterToAutomation implements Action
{
    public function execute(Automation $automation, array $input): AutomationFilter
    {
        Validator::make($input, [
            'form_class' => ['required', 'string'],
            'name'       => ['nullable', 'string', 'max:100'],
        ])->validate();

        return $this->addFilter($automation, $input);
    }

    private function addFilter(Automation $automation, array $input): AutomationFilter
    {
        return $automation->filters()->create([
            'name'       => $input['name'] ?? null,
            'form_class' => $input['form_class'],
        ]);
    }
}
