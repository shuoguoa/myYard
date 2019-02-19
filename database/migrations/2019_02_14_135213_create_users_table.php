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
            $table->increments('id');
            $table->string('username', 32);
            $table->string('account', 32);
            $table->string('password', 60);
            $table->rememberToken();
            $table->unsignedBigInteger('addtime');
            $table->tinyInteger('state')->unsigned()->default(1);
//            $table->timestamps();
        });

        Schema::create('tb_category', function(Blueprint $table){
            $table->increments('id');
            $table->string('name', 32);
            $table->unsignedBigInteger('count')->default(0);
            $table->integer('uid');
            $table->tinyInteger('state')->unsigned()->default(1);//分类的状态：1正常 0删除
        });

        Schema::create('tb_records', function(Blueprint $table){
            $table->increments('id');
            $table->string('title', 64);
            $table->text('content')->nullable();
            $table->integer('cid');//笔记类型
            $table->integer('uid');//用户的id
            $table->unsignedInteger('addtime')->default(0);//笔记类型
            $table->tinyInteger('state')->default(1)->unsigned();

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
        Schema::dropIfExists('tb_category');
        Schema::dropIfExists('tb_records');
    }
}
