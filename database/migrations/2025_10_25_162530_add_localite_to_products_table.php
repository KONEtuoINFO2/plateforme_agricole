<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('localite')->after('description')->nullable();
            $table->string('quantite')->change(); // permet d’accepter texte comme "2 tonnes"
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('localite');
            $table->integer('quantite')->change(); // retour à l’ancien type
        });
    }
};
