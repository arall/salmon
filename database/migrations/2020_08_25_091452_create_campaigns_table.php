<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            $table->string('name')->nullable();
            $table->bigInteger('domain_id')->unsigned()->nullable();
            $table->bigInteger('template_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('campaign_statuses');
            $table->foreign('type_id')->references('id')->on('campaign_types')->onDelete('CASCADE');
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('CASCADE');
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
