<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * FormRequest untuk validasi perubahan data kategori.
 */
class UpdateKategoriMateriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk update kategori.
     */
    public function rules(): array
    {
        return [
            'nama_kategori' => ['required', 'string', 'max:100', Rule::unique('kategori_materi', 'nama_kategori')->ignore($this->route('kategori'), 'id_kategori_materi')],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    /**
     * Label atribut dalam Bahasa Indonesia.
     */
    public function attributes(): array
    {
        return [
            'nama_kategori' => 'Nama Kategori',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
