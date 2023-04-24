<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_tasks', function (Blueprint $table) {
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->text('url');
            $table->timestamp('submit_date')->default(Carbon::now());
            $table->enum('status', ['done', 'submit', 'late'])->default('submit');
            $table->integer('score')->max(100);
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
        Schema::dropIfExists('user_has_tasks');
    }
};
