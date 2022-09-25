<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRatesTable2 extends Migration
{
    public function up()
    {
        Schema::table('rates', function($table) {
            $table->decimal('can_book_rate', 9, 3);
        });
    }

    public function down()
    {
        Schema::table('rates', function($table) {
            $table->dropColumn('can_book_rate');
        });
    }
}
