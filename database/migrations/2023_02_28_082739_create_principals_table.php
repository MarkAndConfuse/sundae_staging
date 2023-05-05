<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrincipalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('principals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('principal_id')->unsigned();
            $table->string('customer_number')->length(60)->nullable();
            $table->string('customer_name')->length(120)->nullable();
            $table->string('brand')->length(120)->nullable();
			$table->string('contact_person')->length(120)->nullable();
            $table->string('email')->length(120)->nullable();
            $table->string('mobile_no')->length(120)->nullable();
            $table->string('designation')->length(120)->nullable();
            $table->string('remarks')->length(120)->nullable();
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
        Schema::dropIfExists('principals');
    }
}
