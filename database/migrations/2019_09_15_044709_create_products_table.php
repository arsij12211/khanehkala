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
            $table->bigInteger('id')->unique()->unsigned();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('details')->nullable();
            $table->decimal('price_main', 17, 0)->default(0);
            $table->bigInteger('number')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('meta_title')->default(null);
            $table->string('meta_keyword')->default(null);
            $table->string('meta_description')->default(null);
            $table->boolean('type', 0)->default(0);     //  product type
            $table->integer('active')->default(1);
            $table->integer('active_special')->default(0);
            $table->integer('totalSelling')->default(0);
            $table->integer('totalVisited')->default(0);

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('set null');
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
