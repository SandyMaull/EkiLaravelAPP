<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteOutRequest extends FormRequest
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
            'sell_id' => 'required|exists:sells,id',
            'note_id' => 'required|exists:notes,id'
        ];
    }
}
