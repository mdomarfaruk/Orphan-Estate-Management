<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('bank_infos', function (Blueprint $table) {
//        $table->increments('id');
//        $table->string('name',120);
//        $table->string('account_no',60);
//        $table->string('bank_address',255);
//        $table->string('author_name',120);
//        $table->string('author_address',255);
//        $table->string('author_telephone',30);
//        $table->tinyInteger('is_active')->unsigned()->comment('1=active, 2=inactive, 0=delete')->default($value=1);
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
//        Schema::drop('bank_infos');
    }
}
