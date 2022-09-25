<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('registrations', function($table) {
            $table->boolean('can_book')->default(false)->after('priority_dates');
            $table->decimal('can_book_rate', 9, 3)->default(0.000)->after('can_book');
            $table->integer('can_book_days')->default(2)->after('can_book_rate');
        });
    }

    public function down()
    {
        Schema::table('registrations', function($table) {
            $table->dropColumn('can_book');
            $table->dropColumn('can_book_rate');
            $table->dropColumn('can_book_days');
        });
    }
}
