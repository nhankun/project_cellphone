<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigInteger('provider_id')->unsigned();
            $table->bigInteger('manufacturer_id')->unsigned();
            $table->string('name');
            $table->integer('quantity');
            $table->integer('price');
            $table->text('description')->nullable();
            $table->smallInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->foreign('provider_id')
                ->references('id')->on('providers')
                ->onDelete('cascade');

            $table->foreign('manufacturer_id')
                ->references('id')->on('manufacturers')
                ->onDelete('cascade');
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
