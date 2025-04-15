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
        if (Schema::hasColumn('events', 'user_id')) {
            Schema::table('events', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->change(); // Autorise la valeur NULL
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Révocation du changement de la colonne
        if (Schema::hasColumn('events', 'user_id')) {
            Schema::table('events', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable(false)->change(); // Supprime la possibilité de NULL
            });
        }
    }
};
