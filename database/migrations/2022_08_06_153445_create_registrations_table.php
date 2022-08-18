<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('fullname');
            $table->string('facebook_name');
            $table->string('registration_type');
            $table->string('local_church');
            $table->string('country');
            $table->string('category');
            $table->string('attending_option');
            $table->string('payment_status')->default('Unsettled');
            $table->json('other_details');
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
        Schema::dropIfExists('registrations');
    }
}
