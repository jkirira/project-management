<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tenant_id');
            $table->integer('amount');
            $table->integer('arrears');
            $table->date('upcoming_payment_amount');
            $table->date('upcoming_payment_date');
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
        Schema::dropIfExists('financial_records');
    }
}
