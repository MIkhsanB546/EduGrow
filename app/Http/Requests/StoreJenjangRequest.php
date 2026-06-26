<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * FormRequest untuk validasi penyimpanan jenjang baru.
 */
class StoreJenjangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk jenjang baru.
     */
    public function rules(): array
    {
        return [
            'nama_jenjang' => ['required', 'string', 'max:50', 'unique:jenjang,nama_jenjang'],
        ];
    }

    /**
     * Label atribut dalam Bahasa Indonesia.
     */
    public function attributes(): array
    {
        return [
            'nama_jenjang' => 'Nama Jenjang',
        ];
    }
}
