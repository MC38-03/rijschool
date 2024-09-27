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
        Schema::create('instructeurs', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->string('achternaam');
            $table->string('email')->unique();
            $table->unsignedBigInteger('voertuig_id')->nullable();
            $table->foreign('voertuig_id')->references('id')->on('voertuigen')->onDelete('set null');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructeur');
    }
};
