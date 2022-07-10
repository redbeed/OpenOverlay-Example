<?php

namespace App\Http\Controllers\Automations\Filter;

use App\OpenOverlay\Actions\Filter\AddFilterToAutomation;
use App\OpenOverlay\Models\Automation;
use Illuminate\Http\Request;

class CreateFilterController
{
    public function __invoke(Request $request, Automation $automation, AddFilterToAutomation $action)
    {
        $filter = $action->execute($automation, $request->all());

        if (empty($filter)) {
            return redirect()->back()->withErrors(['error' => 'Filter could not be created']);
        }

        return redirect()->back()->with(['success' => 'Filter created']);
    }
}
