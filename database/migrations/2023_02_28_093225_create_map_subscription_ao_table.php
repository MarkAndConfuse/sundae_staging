<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapSubscriptionAoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_subscription_ao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_id')->length(40)->nullable();
            $table->string('ao')->length(120)->nullable();
            $table->string('account_id')->length(40)->nullable();
            $table->string('account_name')->length(120)->nullable();
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
        Schema::dropIfExists('map_subscription_ao');
    }
}
