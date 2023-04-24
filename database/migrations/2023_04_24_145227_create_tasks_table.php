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
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('master_class_material_id')->references('id')->on('master_class_material')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('class_id')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->text('description');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->boolean('closed');
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
        Schema::dropIfExists('tasks');
    }
};
