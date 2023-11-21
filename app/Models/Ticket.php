<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function consultation() {
        return $this->belongsTo(Consultation::class);
    }

    public function point_vente(){
        return $this->belongsTo(Point_Vente::class);
    }

    public function caisse(){
        return $this->hasMany(Caisse::class);
    }

    public function soin(){
        return $this->hasMany(Soin::class);
    }

    public function soin_en_attente(){
        return $this->hasOne(Soin::class);
    }
}
