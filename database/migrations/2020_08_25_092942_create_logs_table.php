<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('hook_id')->unsigned();
            $table->string('ip')->nullable();
            $table->longText('data')->nullable();
            $table->dateTime('date');
        });

        Schema::table('logs', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('log_types');
            $table->foreign('hook_id')->references('id')->on('hooks')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
