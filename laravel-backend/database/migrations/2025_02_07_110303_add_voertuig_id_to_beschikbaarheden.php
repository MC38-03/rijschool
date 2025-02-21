<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('beschikbaarheden', function (Blueprint $table) {
            $table->unsignedBigInteger('voertuig_id')->nullable()->after('instructeur_id');
            $table->foreign('voertuig_id')->references('id')->on('voertuigen')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('beschikbaarheden', function (Blueprint $table) {
            $table->dropForeign(['voertuig_id']);
            $table->dropColumn('voertuig_id');
        });
    }

};
