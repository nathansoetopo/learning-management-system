<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->enum('type', ['file', 'image', 'url']);
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
        Schema::dropIfExists('tasks_assets');
    }
};
