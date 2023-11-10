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
        Schema::create('consultation_i_p_m_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('i_p_m_id');
            $table->foreign('i_p_m_id')
                ->references('id')
                ->on('i_p_m_s')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('consultation_id');
            $table->foreign('consultation_id')
                    ->references('id')
                    ->on('consultations')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
            $table->integer('prix_consultation_ipm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_i_p_m_s');
    }
};
