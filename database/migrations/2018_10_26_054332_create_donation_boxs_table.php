<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationBoxsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_boxs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('box_no',60);
            $table->string('box_location',255);
            $table->string('custodian_name',80)->nullable();
            $table->date('established_date');
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
