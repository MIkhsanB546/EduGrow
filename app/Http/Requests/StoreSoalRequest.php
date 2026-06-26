<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * FormRequest untuk validasi penyimpanan soal baru.
 */
class StoreSoalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk soal baru.
     */
    public function rules(): array
    {
        return [
            'pertanyaan' => ['required', 'string'],
            'pilihan_jawaban' => ['required', 'array', 'min:4'],
            'pilihan_jawaban.*.jawaban' => ['required', 'string'],
            'jawaban_benar' => ['required', 'integer', 'min:0'],
        ];
    }

    /**
     * Label atribut dalam Bahasa Indonesia.
     */
    public function attributes(): array
    {
        return [
            'pertanyaan' => 'Pertanyaan',
            'pilihan_jawaban' => 'Pilihan Jawaban',
            'pilihan_jawaban.*.jawaban' => 'Jawaban',
            'jawaban_benar' => 'Jawaban Benar',
        ];
    }

    /**
     * Validasi tambahan: memastikan indeks jawaban benar valid.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $jawabanBenar = $this->input('jawaban_benar');
            $pilihan = $this->input('pilihan_jawaban', []);

            if (!isset($pilihan[$jawabanBenar])) {
                $validator->errors()->add('jawaban_benar', 'Indeks jawaban benar tidak valid.');
            }
        });
    }
}
