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
        Schema::create('facturen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructeur_id');
            $table->unsignedBigInteger('leerling_id');
            $table->decimal('bedrag', 10, 2);
            $table->date('datum_uitgegeven');
            $table->date('verval_datum');
            $table->enum('status', ['open', 'betaald']);
            
            $table->foreign('instructeur_id')->references('id')->on('instructeurs')->onDelete('cascade');
            $table->foreign('leerling_id')->references('id')->on('leerling')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factuur');
    }
};
