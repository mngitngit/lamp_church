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
            $table->string('email')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('fullname');
            $table->string('facebook_name')->nullable();
            $table->string('registration_type');
            $table->string('local_church');
            $table->string('cluster_group')->nullable();
            $table->string('country');
            $table->string('category');
            $table->string('attending_option');
            $table->decimal('rate', 9, 3)->default(0.000);
            $table->string('payment_status')->default('Unsettled');
            $table->string('booking_status')->default('Pending');
            $table->string('with_awta_card')->default('none');
            $table->decimal('can_book_rate', 9, 3)->default(0.000);
            $table->integer('can_book_days')->default(2);
            $table->integer('rebooking_limit')->default(3);
            $table->boolean('is_booking_bypassed')->default(false);
            $table->date('visitor_to_member')->nullable();
            $table->text('notes');
            $table->text('activities');
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
