<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Schema::table('leerling', function (Blueprint $table) {
        //     $table->string('role')->default('leerling');
        // });
    }
    
    public function down()
    {
        Schema::table('leerling', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
    
};
