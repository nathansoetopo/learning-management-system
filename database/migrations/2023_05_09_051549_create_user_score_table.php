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
        Schema::create('user_score', function (Blueprint $table) {
            $table->foreignUuid('class_id')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('material_id')->references('id')->on('material')->onDelete('cascade')->onUpdate('cascade');
            $table->double('average');
            $table->enum('predicate', ['A','B','C','D','E','F']);
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
        Schema::dropIfExists('user_has_score');
    }
};
