<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Logs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 256)->nullable();
            $table->string('operation_id', 256)->nullable();
            $table->string('table_name', 256)->nullable();
            $table->text('message')->nullable();
            $table->longText('data_json')->nullable();
            $table->longText('model_json')->nullable();
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
        Schema::dropIfExists('Logs');
    }
}
