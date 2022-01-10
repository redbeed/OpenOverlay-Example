<?php

namespace App\Http\Requests\Bot\ChatCommand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'command'  => [
                'required',
                Rule::unique('bot_chat_command')->ignore($this->commandId)
            ],
            'response' => 'required',
        ];
    }
}
