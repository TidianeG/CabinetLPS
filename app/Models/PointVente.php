<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointVente extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'nom_point_vente',
        'gerant',
        'description',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }

    public function encaissement(){
        return $this->hasMany(Encaissement::class);
    }

    public function statut_caisse(){
        return $this->hasOne(StatutCaisse::class);
    }
}
