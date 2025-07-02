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
        Schema::table('job_proposals', function (Blueprint $table) {
            $table->integer('load_from')->default(0)->after('is_rejected');
            $table->integer('is_synced')->default(0)->after('load_from');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_proposals', function (Blueprint $table) {
            //
        });
    }
};
