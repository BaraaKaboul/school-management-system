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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('amount',8,2);
            $table->foreignId('Grade_id')->constrained('Grades')->cascadeOnDelete();
            $table->foreignId('Classroom_id')->constrained('Classrooms')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->string('year');
            $table->tinyInteger('fees_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
