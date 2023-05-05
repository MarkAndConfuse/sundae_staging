<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsOnSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('mat_number')->length(60)->nullable();
            $table->text('mat_desc')->nullable();
            $table->string('ao_id')->length(60)->nullable();
            $table->string('terms')->length(120)->nullable();
            $table->string('customer_number')->length(60)->nullable();
            $table->string('customer_id')->length(60)->nullable();
            $table->string('contact_id')->length(60)->nullable();
            $table->string('principal_id')->length(60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            //
        });
    }
}
