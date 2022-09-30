<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRegistrationsTable2 extends Migration
{
    public function up()
    {
        Schema::table('registrations', function($table) {
            $table->integer('rebooking_limit')->default(3)->after('can_book_days');
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
            $table->dropColumn('rebooking_limit');
        });
    }
}
