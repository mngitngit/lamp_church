<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function($table) {
            $table->string('local_church')->after('slot_id');
        });
    }

    public function down()
    {
        Schema::table('bookings', function($table) {
            $table->dropColumn('local_church');
        });
    }
}
