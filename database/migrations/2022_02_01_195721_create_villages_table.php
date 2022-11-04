<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upazilla_id');
            $table->unsignedBigInteger('union_id');
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->timestamps();
            $table->foreign('union_id')->references('id')->on('unions')->onDelete('cascade');
            $table->foreign('upazilla_id')->references('id')->on('upazillas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villages');
    }
}
