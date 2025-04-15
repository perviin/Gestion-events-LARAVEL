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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('location')->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('presenter')->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });

        // Table pivot pour les inscriptions aux activités
        Schema::create('activity_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('registered'); // registered, cancelled, attended
            $table->timestamp('registration_time')->useCurrent();
            $table->timestamps();
            
            // Empêcher les inscriptions en double
            $table->unique(['user_id', 'activity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_registrations');
        Schema::dropIfExists('activities');
    }
};