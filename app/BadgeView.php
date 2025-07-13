<?php

namespace App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeView extends Model
{
    protected $fillable = ['user_id', 'enquete_id'];
}
