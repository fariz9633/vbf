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
        Schema::create('pwa_admin', function (Blueprint $table) {
            $table->integer('admin_id', true);
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique('email');
            $table->string('password')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['0', '1'])->nullable()->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('pwa_admin');
    }
};
