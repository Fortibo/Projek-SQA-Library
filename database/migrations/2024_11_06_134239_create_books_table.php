<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");
            $table->string('judul')->charset('utf8mb4');
            $table->string('penulis')->charset('utf8mb4');
            $table->text('deskripsi')->charset('utf8mb4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
