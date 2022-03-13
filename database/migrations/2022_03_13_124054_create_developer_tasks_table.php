<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeveloperTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('developer_id');
            $table->unsignedBigInteger('task_id');
            $table->integer('week');

            $table->foreign('developer_id')->references('id')->on('developers');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer_tasks');
    }
}
