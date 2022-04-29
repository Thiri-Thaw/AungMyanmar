<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale__details', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_id');
            $table->integer('item_id');
            $table->integer('category_id');
            $table->double('sale_price');
            $table->double('quantity');
            $table->date('sale_date');
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
        Schema::dropIfExists('sale__details');
    }
}
