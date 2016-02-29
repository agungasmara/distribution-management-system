<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //


        Schema::table('users', function($table){

            $table->integer('user_role')->nullable();
            $table->string('email')->nullable()->change();
            $table->string('username')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::table('users', function($table){

            $table->dropColumn('user_role');
            $table->dropColumn('email');
            $table->dropColumn('username');

        });
    }
}
