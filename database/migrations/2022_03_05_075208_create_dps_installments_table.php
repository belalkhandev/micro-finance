<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpsInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dps_installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('dps_application_id');
            $table->integer('dps_installment_no')->default(0);
            $table->double('deposit', 8, 2)->default(0);
            $table->double('withdraw', 8, 2)->default(0);
            $table->double('balance', 8, 2)->default(0);
            $table->date('installment_date', )->nullable();
            $table->date('due_date', )->nullable();
            $table->date('deposit_date', )->nullable();
            $table->text('remarks', )->nullable();
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
        Schema::dropIfExists('dps_installments');
    }
}
