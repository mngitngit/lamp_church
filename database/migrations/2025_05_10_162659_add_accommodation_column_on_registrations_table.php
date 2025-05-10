<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccommodationColumnOnRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('with_accommodation')->after('booked_date');
        });

        Schema::table('slots', function (Blueprint $table) {
            $table->softDeletes(); // adds `deleted_at` column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn('with_accommodation'); 
        });

        Schema::table('slots', function (Blueprint $table) {
            $table->dropColumn('deleted_at'); 
        });
    }
}
