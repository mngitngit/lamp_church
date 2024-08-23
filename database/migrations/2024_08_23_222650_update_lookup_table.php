<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('look_ups', function ($table) {
            $table->char('avail_new_lamp_id')->after('can_book_days')->nullable();
            $table->string('cluster_group')->after('avail_new_lamp_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('look_ups', function ($table) {
            $table->dropColumn('avail_new_lamp_id');
            // $table->dropColumn('cluster_group');
        });
    }
}
