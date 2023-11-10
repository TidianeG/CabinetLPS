<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointVente extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }

    public function encaissement(){
        return $this->hasMany(Encaissement::class);
    }
}
