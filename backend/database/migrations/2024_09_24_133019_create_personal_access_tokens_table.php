<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leerling', function (Blueprint $table) {
            $table->id();
            $table->string('gebruikersnaam')->unique();
            $table->string('naam');
            $table->string('achternaam');
            $table->date('geboortedatum'); 
            $table->string('email')->unique();
            $table->string('wachtwoord');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('leerling');
    }
};
