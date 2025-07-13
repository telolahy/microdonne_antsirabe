<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    protected $table = 'enquetes';
    protected $fillable = ['nom', 'description','images','direction_id'];

    public function direction(){
        return $this->belongsTo(Direction::class);
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function fichiers()
    {
        return $this->hasMany(File::class);
    }

}
