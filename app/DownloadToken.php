<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadToken extends Model
{ 
    protected $fillable = ['email', 'file_id', 'token', 'expires_at', 'user_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
