<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImportantFieldToMilestone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('milestones', function(Blueprint $table) {
            $table->tinyInteger('is_important')->default(0)->after('milestone_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('milestones', function(Blueprint $table) {
            $table->dropColumn('is_important');
        });
    }
}
