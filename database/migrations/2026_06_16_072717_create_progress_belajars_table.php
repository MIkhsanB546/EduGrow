<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress_belajar', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('materi_id')
                ->constrained('materi')
                ->cascadeOnDelete();

            $table->enum('status', [
                'belum_mulai',
                'sedang_belajar',
                'selesai'
            ])->default('belum_mulai');

            $table->unsignedTinyInteger('progress_persen')
                ->default(0);

            $table->timestamps();

            $table->unique([
                'student_id',
                'materi_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_belajar');
    }
};
