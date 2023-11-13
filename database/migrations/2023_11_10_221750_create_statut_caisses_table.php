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
        Schema::create('statut_caisses', function (Blueprint $table) {
            $table->id();
            $table->integer('statut');
            $table->unsignedBigInteger('point_vente_id');
            $table->foreign('point_vente_id')
                    ->references('id')
                    ->on('point_ventes')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statut_caisses');
    }
};
