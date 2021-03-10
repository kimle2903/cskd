<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBussinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('type_investment_id');
            $table->foreign('type_investment_id')->references('id')->on('type_investments');
            $table->unsignedInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->unsignedInteger('ward_id');
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->string('address');
            $table->string('code')->comment('mã số doanh nghiêp');
            $table->string('day_register');
            $table->integer('status');
            $table->integer('member_person');
            $table->string('member_certificate');
            $table->string('day_member_certificate');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('user_id');
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
        Schema::dropIfExists('bussiness');
    }
}
