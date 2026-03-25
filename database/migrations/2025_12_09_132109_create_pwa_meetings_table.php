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
        Schema::create('pwa_meetings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('eid', 100)->nullable();
            $table->string('mominv', 100)->nullable();
            $table->integer('modeid')->nullable();
            $table->string('title')->nullable();
            $table->string('mode', 100)->nullable();
            $table->text('details')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('descp')->nullable();
            $table->string('location')->nullable();
            $table->string('prime_member')->nullable();
            $table->string('prime_member_desig')->nullable();
            $table->string('prime_member_image')->nullable();
            $table->text('secondary_member_image')->nullable();
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
        Schema::dropIfExists('pwa_meetings');
    }
};
