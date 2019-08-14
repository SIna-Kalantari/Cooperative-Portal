<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_access', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('roleId');
            $table->unsignedBigInteger('accessId');
            // $table->timestamps();

            $table->foreign('roleId')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('accessId')
            ->references('id')->on('accessibilities')
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
        Schema::dropIfExists('role_access');
    }
}
