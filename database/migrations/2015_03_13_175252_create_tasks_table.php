<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('destroyer_id')->unsigned()->nullable();
            $table->integer('priority_id')->unsigned()->nullable();
            $table->integer('assignment_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->text('location')->nullable();
            $table->timestamp('starting_date');
            $table->timestamp('finishing_date');
            $table->timestamp('finished_at')->nullable();
            $table->boolean('completed')->default(false);
            $table->boolean('is_assigned')->default(false);
            $table->softDeletes();
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
        Schema::drop('tasks');
    }
}
