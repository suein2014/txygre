<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterWordlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wordlists', function (Blueprint $table) {
            $table->string('phrase',2047)->after('contents'); //after适用于mysql
            $table->string('example',4095)->after('contents'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wordlists', function (Blueprint $table) {
            //
        });
    }
}
