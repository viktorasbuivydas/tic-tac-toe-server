<?php

namespace App\Http\Requests\Action;

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
            'x' => ['required', 'integer'],
            'y' => ['required', 'integer'],
            'is_x' => ['required', 'boolean'],
            'game_uid' => ['required', 'string']
        ];
    }
}
