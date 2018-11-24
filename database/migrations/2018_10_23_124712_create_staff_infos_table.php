<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('staff_infos', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('staff_id',20);
//            $table->string('name_eng',120);
//            $table->string('name_bng',120);
//            $table->string('father_name',120);
//            $table->string('mother_name',120);
//            $table->string('address',255);
//            $table->Integer('designation_id')->unsigned()->comment('#all_settings type=1');
//            $table->Integer('role_id')->unsigned()->comment('#all_settings type=3');
//            $table->Integer('department_id')->unsigned()->comment('#all_settings type=2');
//            $table->date('birth_date');
//            $table->date('join_date');
//            $table->decimal('salary',10,2);
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
