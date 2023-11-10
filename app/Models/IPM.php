<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPM extends Model
{
    use HasFactory;

    public function consultation_i_p_m(){
        return $this->hasMany(ConsultationIPM::class);
    }

    public function client(){
        return $this->hasMany(Client::class);
    }
}
