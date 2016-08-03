<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestoneUserMigration extends Migration
{
    /**
     * Run the migrations.
     * this migration is the pivot table of the milestone and user many to many relationship
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestone_user', function (Blueprint $table) {

            // INT, id for the miletsone_user
            $table->increments('id');
            // FLOAT, days ETA for the milestone
            $table->float('days');

            // INT, foreign key of milestone
            $table->integer('milestone_id')->unsigned();
            $table->foreign('milestone_id')->references('id')->on('milestones')->onDelete('cascade');

            // INT, foreign key of users
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('milestone_user');
    }
}