<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('quiz_id')
                ->constrained('quiz')
                ->cascadeOnDelete();

            $table->decimal('skor_persen', 5, 2)
                ->default(0);

            $table->tinyInteger('bintang')
                ->default(0);

            $table->timestamp('tanggal_pengerjaan')
                ->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
