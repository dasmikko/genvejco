<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortlinkViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shortlink_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shortlink_id')->unsigned();
            $table->foreign('shortlink_id')->references('id')->on('shortlinks');
            $table->string('referer');
            $table->string('ip');
            $table->string('useragent');
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
        Schema::drop('shortlink_views');
    }
}
