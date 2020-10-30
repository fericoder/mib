<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->string('fName');
            $table->string('lName');
            $table->string('fatherName');
            $table->string('sh-shenasname');
            $table->string('sh-meli');
            $table->string('issue');
            $table->string('birthCity');
            $table->string('birthdate');
            $table->string('tahol');
            $table->string('takallof');
            $table->string('address');
            $table->string('mobile');
            $table->string('phone');
            $table->string('phone-zaroori');
            $table->string('email');
            $table->string('language');
            $table->string('ashnaei');
            $table->string('azmayeshi');
            $table->string('azmayeshiMonths');
            $table->string('hoghoogh');
            $table->text('rezume');
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
        Schema::dropIfExists('employments');
    }
}
