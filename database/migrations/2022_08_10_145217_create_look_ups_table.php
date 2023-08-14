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
            $table->string('lamp_card_number')->primary();
            $table->string('old_lamp_card_number')->nullable();
            $table->string('email')->nullable();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('facebook_name')->nullable();
            $table->string('registration_type');
            $table->string('local_church');
            $table->string('cluster_group')->nullable();
            $table->string('country');
            $table->string('category');
            $table->boolean('is_registered')->default(false);
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
