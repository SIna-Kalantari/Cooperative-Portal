<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('title');
            $table->integer('totalPrice');
            $table->char('clientName');
            $table->unsignedBigInteger('projectAdmin');
            $table->unsignedBigInteger('marketer');
            $table->string('descriptions')->nullable();
            $table->date('starting_at')->nullable();
            $table->date('ending_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('projectAdmin')
            ->references('id')->on('users');

            $table->foreign('marketer')
            ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
