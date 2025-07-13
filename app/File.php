<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'file_name', 'file_path', 'status','type', 'published','user_id', 'description', 'direction_id','theme_id','enquete_id','profile',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    public function downloadTokens()
    {
        return $this->hasMany(DownloadToken::class, 'file_id');
    }
    public function enquete()
    {
        return $this->belongsTo(Enquete::class);
    }
    public function historiques()
    {
        return $this->hasMany(Historique::class, 'file_id');
    }
    public function demandes()
{
    return $this->hasMany(Download::class, 'file_id');
}
    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'file_theme', 'file_id', 'theme_id');
    }


}
