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
        Schema::create('presence', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('class_id')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->timestamp('open_clock');
            $table->timestamp('closed_clock');
            $table->double('duration')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presence');
    }
};
