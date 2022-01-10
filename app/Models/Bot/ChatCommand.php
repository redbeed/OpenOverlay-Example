<?php

namespace App\Models\Bot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatCommand extends Model
{
    use HasFactory;

    protected $table = 'bot_chat_command';

    protected $fillable = [
        'command',
        'response',
    ];
}
