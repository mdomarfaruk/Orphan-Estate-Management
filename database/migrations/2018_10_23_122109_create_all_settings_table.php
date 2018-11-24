<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('all_sttings', function (Blueprint $table) {
//            $table->increments('id');
//            $table->tinyInteger('type')->comment('1= designaion 2= department  , 3= role')->unsigned();
//            $table->string('title',120);
//            $table->tinyInteger('is_active')->comment('1= active 2= inactive, 3= delete')->unsigned()->default($value=1);
//            $table->rememberToken();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
