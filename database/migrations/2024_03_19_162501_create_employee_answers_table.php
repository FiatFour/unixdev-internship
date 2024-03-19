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
        Schema::create('employee_answers', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('survey_form_id');
            $table->uuid('question_id');
            $table->uuid('answer_id');
            $table->text('text_answer');

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('survey_form_id')->references('id')->on('survey_forms')->cascadeOnDelete();
            $table->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete();
            $table->foreign('answer_id')->references('id')->on('answers')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_answers');
    }
};
