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
        Schema::create('instructeur_voertuig', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructeur_id');
            $table->unsignedBigInteger('voertuig_id');
            
            $table->foreign('instructeur_id')->references('id')->on('instructeurs')->onDelete('cascade');
            $table->foreign('voertuig_id')->references('id')->on('voertuigen')->onDelete('cascade');
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructeur_voertuig');
    }
};
