<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRegistrationTable3 extends Migration
{
    public function up()
    {
        Schema::table('registrations', function($table) {
            $table->boolean('is_booking_bypassed')->default(false)->after('rebooking_limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function($table) {
            $table->dropColumn('is_booking_bypassed');
        });
    }
}
