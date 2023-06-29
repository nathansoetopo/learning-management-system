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
        Schema::create('master_class_reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('master_class_id')->references('id')->on('master_class')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->double('rate')->max(5);
            $table->text('description');
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
        Schema::dropIfExists('master_class_reviews');
    }
};
