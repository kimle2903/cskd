<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableViolatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('busines_id');
            $table->foreign('busines_id')->references('id')->on('business');
            $table->unsignedInteger('user_decision_id')->nullable(true);
            $table->foreign('user_decision_id')->references('id')->on('users');
            $table->unsignedInteger('user_handler_id');
            $table->foreign('user_handler_id')->references('id')->on('users');
            $table->unsignedInteger('error_violate_id')->nullable(true);
            $table->foreign('error_violate_id')->references('id')->on('error_violates');
            $table->unsignedInteger('form_violate_id')->nullable(true);
            $table->foreign('form_violate_id')->references('id')->on('form_violates');
            $table->unsignedInteger('process_level_id');
            $table->foreign('process_level_id')->references('id')->on('processing_levels');
            $table->unsignedInteger('type_investment_id')->nullable(true);
            $table->foreign('type_investment_id')->references('id')->on('type_investments');
            $table->string('note_error_violate');
            $table->string('note_form_violate')->nullable(true);
            $table->string('day_check');
            $table->integer('status')->comment("1: chưa xử lý, 2: đã xử lý")->nullable(true);
            $table->integer("created_by");
            $table->integer('updated_by');
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
        Schema::dropIfExists('violates');
    }
}
