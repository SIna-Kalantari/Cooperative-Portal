<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_experts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('projectId');
            $table->unsignedBigInteger('expertId');

            $table->foreign('projectId')
            ->references('id')->on('projects');

            $table->foreign('expertId')
            ->references('id')->on('experts');

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
