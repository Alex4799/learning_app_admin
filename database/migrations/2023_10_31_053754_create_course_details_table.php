<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_details', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('user_id');
            $table->integer('status')->default(0);
            $table->string('image25')->nullable();
            $table->string('image50')->nullable();
            $table->string('image75')->nullable();
            $table->string('image100')->nullable();
            $table->string('fee_status')->default('pending');//pending/finish/25%/50%/75%/100%
            $table->integer('done_lesson')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_details');
    }
};
