<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('master_class_id')->references('id')->on('master_class')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('responsible_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->max(60);
            $table->text('description');
            $table->integer('capacity');
            $table->text('link')->nullable();
            $table->timestamp('start_time')->default(Carbon::now());
            $table->timestamp('end_time')->default(Carbon::now());
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('class');
    }
};
