<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jawaban_siswa', function (Blueprint $table) {

            $table->id('id_jawaban_siswa');

            $table->foreignId('id_quiz_attempt')
                ->constrained('quiz_attempts', 'id_quiz_attempt')
                ->cascadeOnDelete();

            $table->foreignId('id_soal')
                ->constrained('soal', 'id_soal')
                ->cascadeOnDelete();

            $table->foreignId('id_pilihan_jawaban')
                ->constrained('pilihan_jawaban', 'id_pilihan_jawaban')
                ->cascadeOnDelete();

            $table->boolean('is_correct');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_siswa');
    }
};
