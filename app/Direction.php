<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    //
    protected $table = 'directions';
    protected $fillable = ['name']; 

    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function enquetes()
    {
        return $this->hasMany(Enquete::class);
    }
    public function themes(){
        return $this->hasMany(Theme::class);
    }

}
