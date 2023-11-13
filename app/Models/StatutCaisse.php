<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatutCaisse extends Model
{
    use HasFactory;

    public function point_vente(){
        return $this->belongsTo(PointVente::class);
    }

    
}
