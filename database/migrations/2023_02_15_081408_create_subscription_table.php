<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subs_id_no')->unsigned();
            $table->string('so_number')->length(50);
            $table->string('invoice_date')->length(50)->nullable();
			$table->string('so_date')->length(50)->nullable();
            $table->string('material_no')->length(50)->nullable();
            $table->text('material_desc')->nullable();
            $table->string('brand')->length(150)->nullable();
            $table->string('category')->length(150)->nullable();
            $table->string('bu')->length(150)->nullable();
            $table->string('assigned_ao')->length(250)->nullable();
            $table->string('activation_date')->length(50)->nullable();
            $table->string('activation_status')->length(150)->nullable();
            $table->string('customer_name')->length(150)->nullable();
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
        Schema::dropIfExists('subscription');
    }
}
