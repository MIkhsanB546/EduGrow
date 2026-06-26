<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * FormRequest untuk validasi perubahan data quiz.
 */
class UpdateQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk update quiz.
     */
    public function rules(): array
    {
        return [
            'id_materi' => ['required', 'exists:materi,id_materi'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'durasi_menit' => ['nullable', 'integer', 'min:1', 'max:999'],
        ];
    }

    /**
     * Label atribut dalam Bahasa Indonesia.
     */
    public function attributes(): array
    {
        return [
            'id_materi' => 'Materi',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'durasi_menit' => 'Durasi (menit)',
        ];
    }
}
