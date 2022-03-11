<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dps_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('dps_application_id');
            $table->integer('transaction_no')->nullable();
            $table->date('transaction_date');
            $table->date('due_date')->nullable();
            $table->double('amount', 8, 2)->default(0);
            $table->double('balance', 8, 2)->default(0);
            $table->boolean('is_paid')->default(false);
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('dps_application_id')->references('id')->on('dps_applications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dps_transactions');
    }
}
