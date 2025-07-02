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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // $table->string('file_path')->nullable();
            $table->string('description')->nullable();  
            $table->string('status')->change();
            $table->string('role')->change();
            $table->string('specification')->nullable();
            $table->string('experience')->change();
            $table->integer('monthly_salary')->nullable();
            $table->integer('hourly_salary')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
