<?php

namespace App\Providers;

use App\OpenOverlay\Models\Automation as AutomationModel;
use Illuminate\Database\Eloquent\Collection;
use Redbeed\OpenOverlay\Automations\AutomationsServiceProvider as OOAutomationsServiceProvider;
use Redbeed\OpenOverlay\Support\Facades\Automation;

class DatabaseAutomationsServiceProvider extends OOAutomationsServiceProvider
{
    public function register()
    {
        parent::register();

        $this->booting(function () {
            $automations = $this->getDatabaseAutomations();
            foreach ($automations as $automation) {
                Automation::add($automation->trigger, $automation->closure());
            }
        });
    }

    /**
     * @return AutomationModel[]|Collection
     */
    public function getDatabaseAutomations(): Collection|array
    {
        return AutomationModel::with(['user', 'actions', 'filters'])->get();
    }
}
