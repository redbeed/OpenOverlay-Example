<?php

namespace App\Http\Requests\Bot\ChatCommand;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'command'  => 'required|unique:bot_chat_command',
            'response' => 'required',
        ];
    }
}
