<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSubIdColumnOnMapSubscriptionAoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('map_subscription_ao', function (Blueprint $table) {
            $table->dropColumn('sub_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_subscription_ao', function (Blueprint $table) {
            $table->dropColumn('sub_id');
        });
    }
}
