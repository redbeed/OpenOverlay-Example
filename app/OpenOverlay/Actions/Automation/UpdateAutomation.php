<?php

namespace App\OpenOverlay\Actions\Automation;

use App\OpenOverlay\Actions\Action;
use App\OpenOverlay\Models\Automation;
use Illuminate\Support\Facades\Validator;

class UpdateAutomation implements Action
{
    public function execute(Automation $automation, array $input): ?Automation
    {
        Validator::make($input, [
            'trigger'     => ['required', 'string', 'max:255'],
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
        ])->validate();

        return $this->update($automation, $input);
    }

    private function update(Automation $automation, array $input): ?Automation
    {
        return $automation->update($input) ? $automation : null;
    }
}
