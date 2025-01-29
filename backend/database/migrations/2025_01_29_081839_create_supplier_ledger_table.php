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
        Schema::create('supplier_ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('supplier_id');
            $table->date('transaction_date');
            $table->enum('type', ['debit', 'credit']);
            $table->double('credited_amount')->nullable();
            $table->double('debited_amount')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('purchase_id')->references('id')->on('purchases');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_ledgers');
    }
};
