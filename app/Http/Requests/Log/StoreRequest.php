<?php

namespace App\Http\Requests\Log;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_uid' => ['required', 'string'],
            'isX' => ['required', 'boolean'],
            'x' => ['required', 'integer'],
            'y' => ['required', 'integer'],
        ];
    }
}