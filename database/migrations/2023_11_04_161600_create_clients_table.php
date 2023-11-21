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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('numero_client')->unique();
            $table->string('nom_client');
            $table->string('prenom_client');
            $table->string('personne_confiance');
            $table->string('telephone_client');
            $table->string('adresse_client');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('ipm_id')->nullable();
            $table->foreign('ipm_id')
                ->references('id')
                ->on('i_p_m_s')
                ->onDelete('restrict')
                ->onUpdate('restrict')
                ->nullable();
            $table->string('participant')->nullable();
            $table->integer('taux_pourcentage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
