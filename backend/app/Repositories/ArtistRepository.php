<?php

namespace App\Repositories;

// use App\Interfaces\ArtistRepositoryInterface\ArtistRepositoryInterface;
use App\Models\Artist;

// class ArtistRepository implements ArtistRepositoryInterface
class ArtistRepository
{
    public function create($data)
    {
        try {
            $artist = Artist::create([
                'name' => $data['name'],
                'dob' => $data['dob'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'first_release_year' => $data['first_release_year'],
                'no_of_albums_released' => $data['no_of_albums_released'],
            ]);
            return $artist;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($artistId, $data)
    {
    }

    public function delete($artistId)
    {
    }

    public function index($request)
    {
    }
}
