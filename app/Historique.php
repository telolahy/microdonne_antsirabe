<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    protected $fillable = [
        'user_id', 'file_id',
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
    public function file()
{
    return $this->belongsTo(File::class, 'file_id'); 
}


}
