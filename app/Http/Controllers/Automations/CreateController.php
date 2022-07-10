<?php

namespace App\Http\Controllers\Automations;

use App\Http\Controllers\Controller;
use App\OpenOverlay\Actions\Automation\CreatesNewAutomation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function store(Request $request, CreatesNewAutomation $action): RedirectResponse
    {
        $automation = $action->execute($request->all());

        return redirect()->route('automations.edit', $automation->id);
    }
}
