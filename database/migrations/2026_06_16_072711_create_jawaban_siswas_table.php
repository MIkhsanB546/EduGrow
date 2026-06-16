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

            $table->foreignId('attempt_id')
                ->constrained('quiz_attempts', 'id_quiz_attempt')
                ->cascadeOnDelete();

            $table->foreignId('soal_id')
                ->constrained('soal', 'id_soal')
                ->cascadeOnDelete();

            $table->foreignId('pilihan_jawaban_id')
                ->constrained('pilihan_jawaban', 'id_pilihan_jawaban')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_siswa');
    }
};
