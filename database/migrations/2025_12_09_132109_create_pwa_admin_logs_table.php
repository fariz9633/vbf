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
        Schema::create('pwa_admin_logs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('adminid')->nullable();
            $table->dateTime('login')->nullable();
            $table->dateTime('logout')->nullable();
            $table->string('ip', 50)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pwa_admin_logs');
    }
};
