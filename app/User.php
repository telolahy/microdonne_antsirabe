<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use App\Direction;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile', 'role', 'direction_id', 
        'prenom', 'adresse', 'telephone', 'profession', 'entite'
    ];
    
    // Vous pouvez aussi créer une relation si la direction est une autre table
    public function isSuperadmin()
    {
        return $this->role === 'superadmin';
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    // Ajouter une méthode pour vérifier si l'utilisateur a une direction
    public function isDirection()
    {
        return isset($this->direction_id);  // Vérifie si l'utilisateur a une direction
    }

    // Méthode pour vérifier si l'utilisateur appartient à une direction spécifique
    public function isInDirection($directionId)
    {
        return $this->direction_id == $directionId;
    }

     

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     // Fonction de notification de vérification par email
     public function sendEmailVerificationNotification()
     {
         $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
     }

    public function downloadTokens()
    {
        return $this->hasMany(DownloadToken::class);
    }
}


