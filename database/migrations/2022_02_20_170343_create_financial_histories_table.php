<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->integer('tenant_id');
            $table->text('payment_method');
            $table->text('target_month');
            $table->dateTime('payment_date');
            $table->integer('payment_amount');
            $table->dateTime('next_payment_due_date');
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
        Schema::dropIfExists('financial_histories');
    }
}
