<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GiftCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GiftCourse', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('giftfname', 256)->nullable();
            $table->string('giftemail', 256)->nullable();
            $table->date('giftdate', 256)->nullable();
            $table->string('giftmessage', 256)->nullable();
            $table->string('course_id', 256)->nullable();
            $table->string('user_id_to', 256)->nullable();
            $table->string('user_id_from', 256)->nullable();
            $table->enum('status', array('yes', 'no'))->default('yes');
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
        Schema::dropIfExists('GiftCourse');
    }
}
