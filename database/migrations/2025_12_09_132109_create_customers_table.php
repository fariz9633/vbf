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
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('reg_id', 50)->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable()->unique('phone');
            $table->string('password')->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->integer('chapter')->nullable();
            $table->integer('category')->nullable();
            $table->integer('subcategory')->nullable();
            $table->date('dob')->nullable();
            $table->date('martial_date')->nullable();
            $table->string('doc')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
