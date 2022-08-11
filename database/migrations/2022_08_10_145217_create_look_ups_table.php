<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('look_ups', function (Blueprint $table) {
            $table->string('awta_card_number')->primary();
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('facebook_name');
            $table->string('registration_type');
            $table->string('local_church');
            $table->string('country');
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('look_ups');
    }
}
