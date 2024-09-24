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
            $table->integer('leeftijd');
            $table->string('email')->unique();
            $table->string('wachtwoord');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
