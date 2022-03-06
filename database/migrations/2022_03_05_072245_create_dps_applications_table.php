<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpsApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dps_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->double('dps_amount',8, 2)->default(0);
            $table->integer('year')->default(3);
            $table->double('total_amount',8, 2)->default(0);
            $table->double('receiving',8, 2)->default(0);
            $table->double('profit',8, 2)->default(0);
            $table->double('balance',8, 2)->default(0);
            $table->enum('dps_type', ['weekly', 'monthly'])->default('weekly');
            $table->string('w_day')->nullable();
            $table->date('m_date')->nullable();
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dps_applications');
    }
}
