<?php

namespace App\Http\Controllers\Automations\Action;

use App\OpenOverlay\Actions\Action\AddActionToAutomation;
use App\OpenOverlay\Models\Automation;
use Illuminate\Http\Request;

class CreateActionController
{
    public function __invoke(Request $request, Automation $automation, AddActionToAutomation $action)
    {
        $filter = $action->execute($automation, $request->all());

        if (empty($filter)) {
            return redirect()->back()->withErrors(['error' => 'Action could not be created']);
        }

        return redirect()->back()->with(['success' => 'Action created']);
    }
}
