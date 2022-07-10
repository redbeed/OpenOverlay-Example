<?php

namespace App\OpenOverlay\Automations;

use Redbeed\OpenOverlay\Automations\AutomationHandler;

class DatabaseAutomation extends AutomationHandler
{
    public static string $name = 'Database based Automation';

    public static string $description = 'Will generate a automations based on the database configuration';

    private array $filters = [];

    private array $actions = [];

    public function setFilters(array $filters): static
    {
        $this->filters = $filters;

        return $this;
    }

    public function setActions(array $actions): static
    {
        $this->actions = $actions;

        return $this;
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function actions(): array
    {
        return $this->actions;
    }
}
