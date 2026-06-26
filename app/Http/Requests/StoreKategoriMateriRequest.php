<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * FormRequest untuk validasi penyimpanan kategori baru.
 */
class StoreKategoriMateriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk kategori baru.
     */
    public function rules(): array
    {
        return [
            'nama_kategori' => ['required', 'string', 'max:100', 'unique:kategori_materi,nama_kategori'],
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
