<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creates the pivot table between projects and users with role assignment
     */
    public function up(): void
    {
        Schema::create('project_user', function (Blueprint $table) {
            // Foreign keys to projects and users tables
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Role type (supervisor or intern)
            $table->string('role'); 
            
            // Composite primary key
            $table->primary(['project_id', 'user_id', 'role']);
            
            // Timestamps for tracking when assignments were made
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_user');
    }
};
