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
        Schema::table('leerling', function (Blueprint $table) {
            $table->date('geboortedatum')->nullable()->change();
            $table->dropColumn('leeftijd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leerling', function (Blueprint $table) {

            $table->integer('leeftijd')->nullable()->default(16);
            $table->dropColumn('geboortedatum');
        });
    }
};
