<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('indices', function (Blueprint $table) {
            $table->uuid('id')->primary();
        });

// references self table needs to be after the table creation
        Schema::table('indices', function (Blueprint $table) {
            $table->foreignUuid('book_id')->constrained();
            $table->foreignUuid('parent_index_id')->nullable()->constrained('indices');
            $table->string('title');
            $table->integer('page');
            $table->softDeletes();
            $table->timestamps();

            $table->index('book_id');
            $table->index('parent_index_id');
            $table->index('title');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indices');
    }
};
