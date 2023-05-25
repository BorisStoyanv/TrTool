<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('elo')->default(600)->change();
            DB::table('users')->whereNull('elo')->update(['elo' => 600]);
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('elo')->nullable()->change();
        });
    }
};
