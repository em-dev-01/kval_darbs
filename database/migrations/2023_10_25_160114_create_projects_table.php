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
    Schema::create('projects', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->string('city')->nullable();
      $table->string('county')->nullable();
      $table->string('parish')->nullable();
      $table->string('village')->nullable();
      $table->string('street')->nullable();
      $table->string('house')->nullable();
      $table->string('apartment')->nullable();
      $table->string('client_name')->nullable();
      $table->string('client_email')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('projects');
  }
};
