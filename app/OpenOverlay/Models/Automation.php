<?php

namespace App\OpenOverlay\Models;

use App\Models\User;
use App\OpenOverlay\Automations\DatabaseAutomation;
use Closure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Redbeed\OpenOverlay\Automations\Triggers\Trigger;

class Automation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'type', 'active', 'trigger'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(AutomationAction::class);
    }

    public function filters(): HasMany
    {
        return $this->hasMany(AutomationFilter::class);
    }

    public function closure(): Closure
    {
        return function (Trigger $trigger) {
            $filters = [];
            $actions = [];

            foreach ($this->filters as $filter) {
                /** @var AutomationFilter $filter */
                $filters[] = (new $filter->form_class)
                    ->prepare($filter->settings ?? [])
                    ->buildObject();
            }

            foreach ($this->actions as $actionModel) {
                /** @var object $actionModel */
                $actions[] = (new $actionModel->form_class)
                    ->prepare($actionModel->settings ?? [])
                    ->buildObject();
            }

            return (new DatabaseAutomation($trigger))
                ->setFilters($filters)
                ->setActions($actions);
        };
    }
}
