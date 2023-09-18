<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'dob', 'gender', 'address', 'first_release_year', 'no_of_albums_released'];

    public function musics()
    {
        return $this->hasMany(Music::class, 'artist_id');
    }
}
