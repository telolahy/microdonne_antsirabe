<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{

    protected $fillable = ['file_id', 'user_id', 'status', 'motif'];

    // Relation avec le modèle File
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le modèle User
    public function rapport()
    {
        return $this->hasOne(Rapports::class, 'download_id');
    }
    public function validateur()
{
    return $this->belongsTo(User::class, 'validated_by');  
}
    public function demandeur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
