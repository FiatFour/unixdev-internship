<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('question_id');
            $table->string('name');
            $table->integer('score')->default(0);
            $table->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
