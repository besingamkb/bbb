<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImplementSoftdelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            // TIMESTAMP, DATE AND TIME WHEN CLIENT WAS DELETED
            $table->softDeletes();
        });

        Schema::table('projects', function(Blueprint $table) {
            // TIMESTAMP, DATE AND TIME WHEN CLIENT WAS DELETED
            $table->softDeletes();
        });
        Schema::table('milestones', function(Blueprint $table) {
            // TIMESTAMP, DATE AND TIME WHEN CLIENT WAS DELETED
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('projects', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('milestones', function(Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
