<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorldlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wordlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('word',45);
            $table->unsignedTinyInteger('list_number');
            $table->unsignedSmallInteger('page_number');
            $table->unsignedTinyInteger('familiar')->default(10); //注意单引号
            $table->string('contents',2047)->nullable();
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
        Schema::dropIfExists('wordlists');
    }
}
