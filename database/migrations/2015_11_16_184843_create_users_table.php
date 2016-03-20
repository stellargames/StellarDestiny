<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

    public function up() {
        Schema::create(
            'users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->tinyInteger('status')->unsigned()->nullable();
            $table->integer('faction_id')->unsigned()->nullable();
            $table->integer('reputation')->unsigned()->default(0);
            $table->integer('alignment')->default(0);
            $table->integer('affiliation')->default(0);
            $table->integer('current_ship')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        }
        );
    }


    public function down() {
        Schema::drop('users');
    }
}
