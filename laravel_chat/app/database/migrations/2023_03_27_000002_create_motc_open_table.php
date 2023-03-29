<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotcOpenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motc_open', function (Blueprint $table) {
            $table->id();
            $table->string('service');
            $table->string('sun_open_hour')->default('09:00');
            $table->string('sun_close_hour')->default('18:00');
            $table->string('mon_open_hour')->default('09:00');
            $table->string('mon_close_hour')->default('18:00');
            $table->string('tue_open_hour')->default('09:00');
            $table->string('tue_close_hour')->default('18:00');
            $table->string('wed_open_hour')->default('09:00');
            $table->string('wed_close_hour')->default('18:00');
            $table->string('thu_open_hour')->default('09:00');
            $table->string('thu_close_hour')->default('18:00');
            $table->string('fri_open_hour')->default('09:00');
            $table->string('fri_close_hour')->default('18:00');
            $table->string('sat_open_hour')->default('09:00');
            $table->string('sat_close_hour')->default('18:00');
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
        Schema::dropIfExists('motc_open');
    }
}
