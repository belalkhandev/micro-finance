<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_category_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->double('amount', 10, 2);
            $table->enum('expense_type', ['assets', 'liabilities', 'regular'])->default('regular');
            $table->date('expense_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
