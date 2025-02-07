<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->comment('The user who created the book')->constrained();
            $table->string('title');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('title');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
