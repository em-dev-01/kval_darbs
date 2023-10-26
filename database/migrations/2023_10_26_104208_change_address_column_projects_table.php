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
      Schema::table('projects', function(Blueprint $table){
        $table->dropColumn('address');
        $table->string('city')->nullable();
        $table->string('county')->nullable();
        $table->string('parish')->nullable();
        $table->string('village')->nullable();
        $table->string('street')->nullable();
        $table->string('house')->default('');
        $table->string('apartment')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
