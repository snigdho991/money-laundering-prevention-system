<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id');
            $table->integer('agency_user_id');
            $table->integer('customer_id');
            $table->integer('company_id')->nullable();
            $table->string('type');
            $table->decimal('amount', 20, 2);
            $table->string('beneficiary')->nullable();
            $table->decimal('fee', 20, 2)->nullable();
            $table->string('photo')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('transactions');
    }
}
