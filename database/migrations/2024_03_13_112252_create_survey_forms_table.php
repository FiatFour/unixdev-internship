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
        Schema::create('survey_forms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('manager_id')->nullable();
            $table->string('name');
            $table->timestamps();

            $table->foreign('manager_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_forms');
    }
};