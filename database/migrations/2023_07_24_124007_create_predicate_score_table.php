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
        Schema::create('predicate_score', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('predicate_id')->references('id')->on('predicate')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('predicate', ['A', 'B', 'C', 'D', 'E']);
            $table->integer('score')->max(100)->min(0);
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
        Schema::dropIfExists('predicate_score');
    }
};
