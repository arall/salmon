<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hooks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campaign_id')->unsigned();
            $table->bigInteger('target_id')->unsigned();
            $table->bigInteger('last_log_type_id')->unsigned()->nullable();
            $table->string('token')->unique();
            $table->timestamps();
        });

        Schema::table('hooks', function (Blueprint $table) {
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('CASCADE');
            $table->foreign('target_id')->references('id')->on('targets')->onDelete('CASCADE');
            $table->foreign('last_log_type_id')->references('id')->on('log_types');
            $table->unique(['campaign_id', 'target_id'], 'hook_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hooks');
    }
}
