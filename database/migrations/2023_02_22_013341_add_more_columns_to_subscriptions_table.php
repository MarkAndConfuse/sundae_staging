<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('contact_details')->length(80)->after('activation_date')->nullable();
            $table->string('customer_email_address')->length(120)->after('contact_details')->nullable();
            $table->string('subscription_term')->length(120)->after('customer_email_address')->nullable();
            $table->string('contract_details')->length(120)->after('subscription_term')->nullable();
            $table->string('payment_schedule')->length(120)->after('contract_details')->nullable();
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
