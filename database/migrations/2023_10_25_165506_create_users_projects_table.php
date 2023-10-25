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
    Schema::create('users_projects', function (Blueprint $table) {
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('project_id');
      $table->primary(['user_id', 'project_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users_projects');
  }
};
