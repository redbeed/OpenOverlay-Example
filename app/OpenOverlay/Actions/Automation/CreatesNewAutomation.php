<?php

namespace App\OpenOverlay\Actions\Automation;

use App\OpenOverlay\Actions\Action;
use App\OpenOverlay\Models\Automation;
use Illuminate\Support\Facades\Validator;

class CreatesNewAutomation implements Action
{
    public function execute(array $input): Automation
    {
        Validator::make($input, [
            'trigger'     => ['required', 'string', 'max:255'],
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
        ])->validate();

        return $this->create($input);
    }

    private function create(array $input): Automation
    {
        return \Auth::user()->automations()->create([
            'trigger'     => $input['trigger'],
            'name'        => $input['name'],
            'description' => $input['description'],
        ]);
    }
}
