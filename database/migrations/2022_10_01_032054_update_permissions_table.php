<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePermissionsTable extends Migration
{
    public function up()
    {
        Schema::table('permissions', function($table) {
            $table->boolean('can_edit_delegate_config')->default(false)->after('can_view_registrations');
        });
    }

    public function down()
    {
        Schema::table('permissions', function($table) {
            $table->dropColumn('can_edit_delegate_config');
        });
    }
}
