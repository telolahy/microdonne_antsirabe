<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rapports extends Model
{
    protected $table = 'rapports';
    protected $fillable = [ 'path', 'download_id'];

    public function download()
    {
        return $this->belongsTo(Download::class, 'download_id');
    }
}
