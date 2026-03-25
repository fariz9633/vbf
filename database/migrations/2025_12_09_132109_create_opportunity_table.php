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
        Schema::create('opportunity', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cust_id')->nullable();
            $table->string('name')->nullable();
            $table->text('descp')->nullable();
            $table->string('phone', 20)->nullable();
            $table->integer('referencetype')->nullable();
            $table->integer('opportunitytype')->nullable();
            $table->integer('referalstatus')->nullable();
            $table->integer('opportunityconnect')->nullable();
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
        Schema::dropIfExists('opportunity');
    }
};
