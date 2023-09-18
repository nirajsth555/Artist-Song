<?php

namespace App\Repositories;

// use App\Interfaces\ArtistRepositoryInterface\ArtistRepositoryInterface;
use App\Models\Artist;

// class ArtistRepository implements ArtistRepositoryInterface
class ArtistRepository
{
    private $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    public function create($data)
    {
        try {
            $artist = $this->artist->create([
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

    public function update(Artist $artist, $data)
    {
        try {
            $artist->update([
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

    public function delete(Artist $artist)
    {
        try {
            $artist->musics()->delete();
            $artist->delete();
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function index($params)
    {
        try {
            $page = $params['page'] ?? 1;
            $limit = $params['limit'] ?? 10;
            $artists = $this->artist->paginate($limit, ['*'], 'page', $page);
            $result = [
                'meta' => [
                    'total' => $artists->total(),
                    'per_page' => $artists->perPage(),
                    'current_page' => $artists->currentPage()
                ],
                'records' => $artists->items()
            ];
            return $result;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
