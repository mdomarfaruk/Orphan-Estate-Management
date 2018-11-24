<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonarInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donar_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',120);
            $table->string('address',255);
            $table->string('email',80)->nullable();
            $table->string('mobile',30);
            $table->string('note',255);
            $table->tinyInteger('is_active')->unsigned()->comment('1=active, 2=inactive, 0=delete')->default($value=1);
            $table->rememberToken();
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
        //
    }
}
