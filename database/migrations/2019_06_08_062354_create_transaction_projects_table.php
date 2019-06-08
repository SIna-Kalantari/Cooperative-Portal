<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transactionId');
            $table->unsignedBigInteger('projectId');
            $table->timestamps();

            $table->foreign('transactionId')
            ->references('id')->on('transactions')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('projectId')
            ->references('id')->on('projects')
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
        Schema::dropIfExists('transaction_projects');
    }
}
