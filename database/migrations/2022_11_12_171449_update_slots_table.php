<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSlotsTable extends Migration
{
    public function up()
    {
        Schema::table('slots', function($table) {
            $table->string('registration_type')->after('seat_count');
        });
    }

    public function down()
    {
        Schema::table('slots', function($table) {
            $table->dropColumn('registration_type');
        });
    }
}
