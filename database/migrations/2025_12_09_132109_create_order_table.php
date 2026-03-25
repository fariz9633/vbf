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
        Schema::create('order', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('reg_id')->nullable();
            $table->string('order_priority', 50)->nullable();
            $table->date('ordered_date')->nullable();
            $table->date('accepted_date')->nullable();
            $table->date('packed_date')->nullable();
            $table->date('shipped_date')->nullable();
            $table->date('tracking_date')->nullable();
            $table->date('delivered_date')->nullable();
            $table->date('labeled_date')->nullable();
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
        Schema::dropIfExists('order');
    }
};
