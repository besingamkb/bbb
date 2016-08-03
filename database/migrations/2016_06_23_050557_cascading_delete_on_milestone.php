<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CascadingDeleteOnMilestone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('milestones', 'project_id')) {
            //
            Schema::table('milestones', function(Blueprint $table) {
                // $table->dropForeign('milestones_project_id_foreign');
                $table->dropForeign(['project_id']);
                $table->dropColumn('project_id');
            });
        }

        Schema::table('milestones', function(Blueprint $table) {
            
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('milestones', 'project_id')) {
            //
            Schema::table('milestones', function(Blueprint $table) {
                // $table->dropForeign('milestones_project_id_foreign');
                $table->dropForeign(['project_id']);
                $table->dropColumn('project_id');
            });
        }

        Schema::table('milestones', function(Blueprint $table) {
            
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }
}
