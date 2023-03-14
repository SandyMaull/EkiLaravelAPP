<?php

namespace App\Http\Requests;

use App\Models\Note;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
        $urlId = $this->route('note');
        $dataId = Note::where('note_num', $urlId)->first();
        $dataId = ($dataId) ? $dataId->id : null;
        return [
            'note_num' => 'required|string|max:255|unique:notes,note_num,' . $dataId,
        ];
    }
}
