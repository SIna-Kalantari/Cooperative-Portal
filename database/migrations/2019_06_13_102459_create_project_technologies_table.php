<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_technologies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('projectId');
            $table->unsignedBigInteger('technologyId');

            $table->foreign('projectId')
            ->references('id')->on('projects')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('technologyId')
            ->references('id')->on('technologies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_technologies');
    }
}
