<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerServiceRelationRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_service_relation_role', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('service')->nullable();
            $table->string('role')->default('user');

            // $table->foreign('service_id')
            //     ->references('id')
            //     ->on('customer_service');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

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
        Schema::dropIfExists('customer_service_relation_role');
    }
}
