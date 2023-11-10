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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->string('type_paiement');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('consultation_id');
            $table->foreign('consultation_id')
                ->references('id')
                ->on('consultations')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('point_vente_id');
            $table->foreign('point_vente_id')
                    ->references('id')
                    ->on('point_ventes')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
            $table->decimal('montant_total', $precision = 8, $scale = 3);
            $table->date('date_creation');
            $table->time('heure_creation');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
