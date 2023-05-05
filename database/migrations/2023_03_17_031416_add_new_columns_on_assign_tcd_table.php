<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsOnAssignTcdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assign_tcd', function (Blueprint $table) {
            $table->string('tcd_name')->length(120)->after('updated_at')->nullable();
            $table->string('email')->length(120)->after('tcd_name')->nullable();
            $table->string('created_by')->length(120)->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assign_tcd', function (Blueprint $table) {
            //
        });
    }
}
