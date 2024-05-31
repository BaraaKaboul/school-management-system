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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->foreignId('fee_invoice_id')->nullable()->constrained('fee_invoices')->cascadeOnDelete();
            $table->foreignId('receipt_id')->nullable()->constrained('receipt_students')->cascadeOnDelete();
            $table->foreignId('processing_id')->nullable()->constrained('processing_fees')->cascadeOnDelete();
            $table->foreignId('payment_id')->nullable()->constrained('payment_students')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
