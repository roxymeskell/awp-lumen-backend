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
        Schema::create('happiness', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->boolean('is_workplace')->default(false);
            // Employee happiness values, as counts of employees.
            $table->unsignedInteger('very_happy')->default(0);
            $table->unsignedInteger('happy')->default(0);
            $table->unsignedInteger('content')->default(0);
            $table->unsignedInteger('unhappy')->default(0);
            $table->unsignedInteger('very_unhappy')->default(0);
        });

        // Seed values
        app('db')->select("INSERT INTO `happiness` (`name`, `very_happy`, `happy`, `content`, `unhappy`, `very_unhappy`) VALUES ('Sales Team', 16, 57, 12, 15, 0)");
        app('db')->select("INSERT INTO `happiness` (`name`, `is_workplace`, `very_happy`, `happy`, `content`, `unhappy`, `very_unhappy`) VALUES ('Workplace', TRUE, 288, 491, 99, 101, 21)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('happiness');
    }
};
