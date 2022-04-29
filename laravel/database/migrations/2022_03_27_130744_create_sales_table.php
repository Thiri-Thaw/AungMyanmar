<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->text('remark')->nullable();
            // $table->double('sub_total');
            $table->double('tax')->default(0.0);
            $table->double('discount')->default(0.0);
            $table->double('paid_amount');
            // $table->double('left_amount');
            $table->date('sale_date');
            $table->string('voucher_id');
            $table->smallinteger('enable')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('edited_by')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
