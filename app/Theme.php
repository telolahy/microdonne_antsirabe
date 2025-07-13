<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['nom', 'nbreDonnee', 'image','description','direction_id'];

    public function direction(){
        return $this->belongsTo(Direction::class);
    }
    public function files(){
        return $this->belongsToMany(File::class, 'file_theme', 'theme_id', 'file_id');
    }

}