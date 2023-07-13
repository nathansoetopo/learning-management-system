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
        Schema::create('article_has_category', function (Blueprint $table) {
            $table->foreignUuid('article_category_id')->references('id')->on('article_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('article_id')->references('id')->on('article')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('article_has_category');
    }
};
