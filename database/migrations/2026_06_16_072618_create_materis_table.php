<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('jenjang_id')
                ->constrained('jenjang')
                ->cascadeOnDelete();

            $table->foreignId('kategori_materi_id')
                ->constrained('kategori_materi')
                ->cascadeOnDelete();

            $table->string('judul');
            $table->text('deskripsi')->nullable();

            $table->string('file_materi')->nullable();
            $table->string('thumbnail')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
