<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creates the project_task_user pivot table to link tasks to users
     * while maintaining the project context through project_task relationship
     */
    public function up()
    {
        Schema::create('project_task_user', function (Blueprint $table) {
            // Primary key
            $table->id();
            
            // References the project_task pivot table
            $table->foreignId('project_task_id')
                  ->constrained('project_task')
                  ->cascadeOnDelete();
                  
            // References the user being assigned
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();
                  
            // Timestamps for tracking
            $table->timestamps();
            
            // Ensure unique assignments
            $table->unique(['project_task_id', 'user_id']);
        });
    }

    /**
     * Drops the table if migration is rolled back
     */
    public function down()
    {
        Schema::dropIfExists('project_task_user');
    }
};