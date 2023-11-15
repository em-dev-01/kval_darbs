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
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('task_title');
            $table->string('unit');
            $table->decimal('amount', 9, 2);
            $table->decimal('task_cost_per_unit', 9, 2)->nullable();
            $table->decimal('material_cost_per_unit', 9, 2)->nullable();
            $table->decimal('total_task_cost', 9, 2)->nullable();
            $table->decimal('total_material_cost', 9, 2)->nullable();
            $table->decimal('total_cost', 9, 2);
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};
