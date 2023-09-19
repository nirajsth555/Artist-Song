<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $table = "musics";

    public $fillable = ['artist_id', 'title', 'album_ame', 'genre'];
}
