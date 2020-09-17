<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->datetime('date');
            $table->integer('patients_id')->unsigned();
            $table->integer('doctors_id')->unsigned();
            $table->string('medical_insurance')->nullable();
            $table->float('value')->nullable();
            $table->text('note')->nullable();
            $table->char('is_active', 1)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patients_id')->nullable()->references('id')->on('patients');
            $table->foreign('doctors_id')->nullable()->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
