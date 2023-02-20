<?php

namespace App\Http\Requests;

use App\Models\Item\KodeBarang;
use Illuminate\Foundation\Http\FormRequest;

class KodeBarangRequest extends FormRequest
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
        $urlId = $this->route('kode_barang');
        $dataId = KodeBarang::where('code', $urlId)->first();
        $dataId = ($dataId) ? $dataId->id : null;
        return [
            'merk_id' => 'required|exists:merks,id',
            'code' => 'required|string|max:255|unique:kode_barangs,code,' . $dataId,
        ];
    }
}
