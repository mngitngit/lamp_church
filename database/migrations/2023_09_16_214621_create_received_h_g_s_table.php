<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivedHGSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_h_g_s', function (Blueprint $table) {
            $table->id();
            $table->string('registration_uuid');
            $table->bigInteger('slot_id')->unsigned();
            $table->string('local_church');
            $table->string('registration_type');
            $table->foreign('registration_uuid')->references('uuid')->on('registrations')->onDelete('cascade');
            $table->foreign('slot_id')->references('id')->on('slots')->onDelete('cascade');
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
        Schema::dropIfExists('received_h_g_s');
    }
}
