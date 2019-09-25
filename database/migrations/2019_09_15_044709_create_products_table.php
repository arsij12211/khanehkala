<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->string('name');
            $table->text('details')->nullable();
            $table->decimal('price_main', 13, 0)->default(0);
            $table->bigInteger('number')->nullable();
            $table->string('slug')->unique()->nullable();
//            $table->decimal('price_off', 13, 0)->default(0);
            $table->integer('active')->default(1);
            $table->integer('active_special')->default(0);
            $table->string('image')->nullable();
            $table->integer('totalSelling')->default(0);
            $table->integer('totalVisited')->default(0);

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('products');
    }
}
