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
        Schema::create('pwa_media', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title')->nullable();
            $table->string('link', 500)->nullable();
            $table->enum('status', ['0', '1'])->nullable()->default('1');
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
        Schema::dropIfExists('pwa_media');
    }
};
