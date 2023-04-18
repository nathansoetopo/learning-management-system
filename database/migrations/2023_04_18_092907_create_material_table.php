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
        Schema::create('material', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('master_class_material_id')->references('id')->on('master_class_material')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->enum('type', ['file', 'image', 'url']);
            $table->text('asset');
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
        Schema::dropIfExists('material');
    }
};
