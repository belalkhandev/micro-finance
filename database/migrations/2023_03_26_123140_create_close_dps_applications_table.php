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
        Schema::create('close_dps_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dps_application_id')->constrained('dps_applications')->cascadeOnDelete();
            $table->double('deposit_balance',10, 2)->default(0);
            $table->double('incentive',8, 2)->default(0);
            $table->enum('incentive_type', config('enums.incentive_types'))->default('flat');
            $table->double('incentive_amount',10, 2)->default(0);
            $table->double('total_payable',10, 2)->default(0);
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
        Schema::dropIfExists('close_dps_applications');
    }
};
