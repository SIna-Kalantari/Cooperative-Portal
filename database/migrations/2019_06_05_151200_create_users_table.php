<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('family');
            $table->char('phone', 10)->unique();
            $table->unsignedBigInteger('roleId');
            $table->unsignedBigInteger('expertId');
            $table->string('password');
            $table->char('lastActivity', 10)->nullable();
            $table->tinyInteger('isActive')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('roleId')
            ->references('id')->on('roles')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('expertId')
            ->references('id')->on('experts')
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
        Schema::dropIfExists('users');
    }
}
