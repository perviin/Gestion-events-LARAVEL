<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location');
            $table->dateTime('date');
            $table->integer('capacity'); // Nombre max de participants
            $table->decimal('price', 8, 2)->default(0); // Prix du billet
            $table->string('image')->nullable(); // Image de l'événement
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
