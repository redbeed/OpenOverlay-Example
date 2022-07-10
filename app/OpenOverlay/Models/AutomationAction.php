<?php

namespace App\OpenOverlay\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutomationAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_class', 'settings', 'name', 'active'
    ];

    protected $casts = [
        'active'   => 'boolean',
        'settings' => 'json'
    ];

    public function automation(): BelongsTo
    {
        return $this->belongsTo(Automation::class);
    }
}
