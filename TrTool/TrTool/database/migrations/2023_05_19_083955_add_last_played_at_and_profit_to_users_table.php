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
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_played_at')->nullable();
            $table->decimal('profit', 10, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_played_at');
            $table->dropColumn('profit');
        });
    }
};
