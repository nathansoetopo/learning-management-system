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
        Schema::create('user_has_class', function (Blueprint $table) {
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('class_id')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('user_has_class');
    }
};
