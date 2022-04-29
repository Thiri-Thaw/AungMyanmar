<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_id')->unique();
            // $table->integer('customer_id');
            $table->unsignedBigInteger('company_id');
            $table->double('tax')->nullable();
            $table->double('discount')->nullable();
            $table->double('paid')->nullable();
            $table->date('date');
            $table->date('remind_date');
            $table->smallInteger('read')->default(0);
            $table->string('remark')->nullable();
            $table->smallinteger('enable')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('edited_by')->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}