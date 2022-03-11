<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpsFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dps_fines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dps_transaction_id');
            $table->double('amount', 8, 2)->default(0);
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
            $table->foreign('dps_transaction_id')->references('id')->on('dps_transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dps_fines');
    }
}
