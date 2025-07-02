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
        Schema::table('job_proposals', function (Blueprint $table) {
            $table->json('attached_resource_ids')->nullable()->after('cover_letter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_proposals', function (Blueprint $table) {
            $table->dropColumn('attached_resource_ids');
        });
    }
};