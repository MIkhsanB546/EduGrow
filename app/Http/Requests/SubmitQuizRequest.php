<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * FormRequest untuk validasi pengiriman jawaban quiz.
 */
class SubmitQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi jawaban quiz.
     */
    public function rules(): array
    {
        return [
            'jawaban' => ['required', 'array'],
            'jawaban.*' => ['required', 'exists:pilihan_jawaban,id_pilihan_jawaban'],
        ];
    }

    /**
     * Label atribut dalam Bahasa Indonesia.
     */
    public function attributes(): array
    {
        return [
            'jawaban' => 'Jawaban',
            'jawaban.*' => 'Setiap jawaban',
        ];
    }
}
