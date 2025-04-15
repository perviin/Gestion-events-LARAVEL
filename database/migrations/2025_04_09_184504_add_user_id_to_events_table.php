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
            // 1. Ajout de la colonne sans contrainte
    Schema::table('events', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable();
    });
    
    // 2. Associer tous les événements existants à un utilisateur (par exemple ID=1)
    // Remplacez 1 par l'ID de l'utilisateur auquel vous voulez lier tous les événements existants
    DB::statement('UPDATE events SET user_id = 1 WHERE user_id IS NULL');
    
    // 3. Ajouter la contrainte de clé étrangère
    Schema::table('events', function (Blueprint $table) {
        // Rendre la colonne non nullable maintenant que toutes les entrées ont une valeur
        $table->unsignedBigInteger('user_id')->nullable(false)->change();
        
        $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
