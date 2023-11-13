<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }

    public function client(){
        return $this->hasMany(Client::class);
    }

    public function consultation(){
        return $this->hasMany(Consultation::class);
    }

    public function point_vente(){
        return $this->hasOne(PointVente::class);
    }

    public function caisse(){
        return $this->hasMany(Caisse::class);
    }

    public function encaissement(){
        return $this->hasMany(Encaissement::class);
    }

    public function soin(){
        return $this->hasMany(Soin::class);
    }
}
