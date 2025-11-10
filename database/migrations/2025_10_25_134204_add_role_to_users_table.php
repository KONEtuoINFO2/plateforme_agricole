
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ici on ajoute la colonne "role" dans la table "users"
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['entreprise', 'agriculteur', 'partenaire'])
                  ->default('agriculteur')
                  ->after('email'); // la colonne sera placée après "email"
        });
    }

    public function down(): void
    {
        // Ici on supprime la colonne "role" si on annule la migration
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};

