<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->string('unicode')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->dropColumn('unicode');
        });
    }
    
};
