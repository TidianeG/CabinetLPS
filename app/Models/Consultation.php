<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_consultation',
        'prix_consultation',
        'description',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }

    public function consultation_i_p_m(){
        return $this->hasMany(ConsultationIPM::class);
    }
}
