<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductattrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productattrs', function (Blueprint $table) {
            $table->bigInteger('id')->unique()->unsigned();                 //  id_product_attribute
            $table->unsignedBigInteger('product_id');
            $table->decimal('wholesale_price', 17, 0)->default(0);      //  (price_main of products table) + (Price of tax)
            $table->bigInteger('number')->nullable();
            $table->bigInteger('minimal_number')->nullable();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('productattrs');
    }
}
