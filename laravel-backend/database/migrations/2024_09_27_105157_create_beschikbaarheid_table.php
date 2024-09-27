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
        Schema::create('beschikbaarheden', function (Blueprint $table) {
            $table->id();
            $table->date('datum');
            $table->time('begin_tijd');
            $table->time('eind_tijd');
            $table->unsignedBigInteger('instructeur_id');
            $table->foreign('instructeur_id')->references('id')->on('instructeurs')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beschikbaarheid');
    }
};
