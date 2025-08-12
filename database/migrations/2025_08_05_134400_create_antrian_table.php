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
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->string('prefix', 10)->comment('Prefix for the queue, e.g., A, B, C');
            $table->integer('number')->comment('Queue number, e.g., 1, 2, 3');
            $table->date('date')->comment('Date of the queue');
            $table->tinyInteger('status')->default(0)->comment('Status of the queue: 0: waiting, 1: called, 2: completed');
            $table->tinyInteger('loket_id')->nullable()->comment('Loket where the queue is processed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
};
