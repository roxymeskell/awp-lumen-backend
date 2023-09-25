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
        Schema::create('employee_happiness', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('team');
            // Employee happiness values, as counts of employees.
            $table->unsignedInteger('very_happy')->default(0);
            $table->unsignedInteger('happy')->default(0);
            $table->unsignedInteger('content')->default(0);
            $table->unsignedInteger('unhappy')->default(0);
            $table->unsignedInteger('very_unhappy')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_happiness');
    }
};
