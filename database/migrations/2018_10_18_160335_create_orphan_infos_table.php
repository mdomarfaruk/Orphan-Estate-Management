<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrphanInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('orphan_infos', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('orphan_id',20);
//            $table->string('name_eng',120);
//            $table->string('name_bng',120);
//            $table->string('father_name',120);
//            $table->string('mother_name',120);
//            $table->string('gardian_name',120);
//            $table->string('	mobile_no',30);
//            $table->string('address',255);
//            $table->date('birth_date');
//            $table->date('admission_date');
//            $table->string('photo',100)->nullable($value = true);
//            $table->string('details',255)->nullable($value = true);
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
