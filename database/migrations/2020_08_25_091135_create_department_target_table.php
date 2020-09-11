<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_target', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('target_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('department_target', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('CASCADE');
            $table->foreign('target_id')->references('id')->on('targets')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_target');
    }
}
