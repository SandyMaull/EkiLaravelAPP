<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerkRequest extends FormRequest
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
        // $urlId = $this->route('city');
        // $dataId = City::where('id', $urlId)->first();
        // $dataId = ($dataId) ? $dataId->id : null;
        return [
            // 'code' => 'required|string|max:255|unique:cities,code,' . $dataId,
            'name' => 'required|string|max:255',
        ];
    }
}
