<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('close_loan_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_application_id')->constrained('loan_applications')->cascadeOnDelete();
            $table->double('payable_loan_amount',10,2)->default(0);
            $table->double('service_amount',10,2)->default(0);
            $table->double('early_payment_discount',10,2)->default(0);
            $table->double('beginning_balance',10,2)->default(0);
            $table->double('payable_amount',10,2)->default(0);
            $table->double('payment',10, 2)->default(0);
            $table->enum('payment_method', config('enums.payment_methods'))->default('cash');
            $table->string('payment_channel')->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('cheque_no')->nullable();
            $table->text('note')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('close_loan_applications');
    }
};
