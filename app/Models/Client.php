<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_client',
        'prenom_client',
        'personne_confiance',
        'telephone_client',
        'adresse_client',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }

    public function ipm(){
        return $this->belongsTo(IPM::class);
    }

    public function soin(){
        return $this->hasMany(Soin::class);
    }

    public function soin_en_attente(){
        return $this->hasOne(Soin::class);
    }
}
