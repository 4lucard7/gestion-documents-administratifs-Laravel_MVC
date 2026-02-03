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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string("reference")->unique()->nullable();
            $table->string("titre")->nullable();
            $table->text("description")->nullable();
            $table->enum("type",  ["facture", "contrat", "rapport", "autre"]);
            $table->string("fichier")->nullable();
            $table->enum("statut",["en_attente", "valide", "rejete"]);
            $table->date("date_depot")->nullable();
            $table->decimal("montant", 10, 2)->default(0)->nullable();
            $table->boolean("est_actif")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
