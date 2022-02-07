<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {

            $table->string('product_number');
            $table->string('category_name');
            $table->string('department_name');
            $table->string('manufacturer_name');
            $table->unsignedBigInteger('upc');
            $table->unsignedBigInteger('sku');
            $table->double('regular_price');
            $table->double('sale_price');
            $table->longText('description');
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
        Schema::dropIfExists('product_categories');
    }
}
