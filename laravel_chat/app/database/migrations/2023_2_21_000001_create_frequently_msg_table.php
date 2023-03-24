<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequentlyMsgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequently_msg', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('type');
            $table->integer('status')->default(0);
            $table->text('reply');
            $table->string('url')->nullable();
            $table->integer('is_err')->default(0);
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
        Schema::dropIfExists('frequently_msg');
    }
}
