<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'kode_barang_id' => 'required|exists:kode_barangs,id',
            'seri' => 'required|string|max:255',
            'quantity' => 'required',
            'karyawan_id' => 'required|exists:kywn__codes,id',
            'verify' => 'required|boolean'
        ];
    }
}
