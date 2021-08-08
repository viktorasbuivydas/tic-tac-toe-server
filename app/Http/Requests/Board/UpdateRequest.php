<?php

namespace App\Http\Requests\Board;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'is_x' => ['required', 'boolean'],
            'square_id' => ['required', 'integer'],
            'square_index' => ['required', 'integer']
        ];
    }
}
