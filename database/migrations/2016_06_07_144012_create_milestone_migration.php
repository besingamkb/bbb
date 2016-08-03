<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestoneMigration extends Migration
{
    /**
     * Run the migrations.
     * this migration is for the milestones
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestones', function (Blueprint $table) {

            // INT, id for the milestone
            $table->increments('id');

            // DATE, date of release
            $table->date('release');

            // INT, foreign key for projects
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');

            // STRING, name of the milestone
            $table->string('milestone_name');

            // timestamps
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
        Schema::drop('milestones');
    }
}