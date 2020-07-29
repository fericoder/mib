<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationItemGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specification_item_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('specification_items');
            $table->bigInteger('product_id')->unsigned()->index();
            $table->bigInteger('amount')->nullable();
            $table->bigInteger('p_id')->unsigned()->unique();
            $table->timestamps();


            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specification_item_groups');
    }
}
