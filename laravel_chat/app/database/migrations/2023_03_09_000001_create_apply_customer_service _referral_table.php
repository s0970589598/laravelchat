<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyCustomerServiceReferralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_customer_service_referral', function (Blueprint $table) {
            $table->id();
            $table->string('assign_service');   //指派
            $table->string('assigned_service'); //被指派
            $table->string('room_id');
            $table->string('assign_reason');
            $table->integer('status')->default(0);
            $table->string('assign_id')->nullable();  //指派人
            $table->string('assigned_id')->nullable();//被指派人
            $table->string('updater')->nullable();    //更新人


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
        Schema::dropIfExists('messages');
    }
}
