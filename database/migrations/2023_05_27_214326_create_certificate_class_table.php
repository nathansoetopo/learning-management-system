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
        Schema::create('certificate_class', function (Blueprint $table) {
            $table->foreignUuid('class_id')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('certificate_id')->references('id')->on('certificate')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('certificate_class');
    }
};
