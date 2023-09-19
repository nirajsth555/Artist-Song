<?php

namespace App\Repositories;

use App\Models\Music;

class MusicRepository
{
    private $music;

    public function __construct(Music $music)
    {
        $this->music = $music;
    }

    public function create($data)
    {
        try {
            $artist = $this->music->create([
                'artist_id' => $data['artist'],
                'title' => $data['title'],
                'album_ame' => $data['albumName'],
                'genre' => $data['genre'],
            ]);
            return $artist;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(Music $music, $data)
    {
        try {
            $music->update([
                'artist_id' => $data['artist'],
                'title' => $data['title'],
                'album_name' => $data['albumName'],
                'genre' => $data['genre'],
            ]);
            return $music;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete(Music $music)
    {
        try {
            $music->delete();
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
            $query = $this->music;
            if (array_key_exists('artistId', $params) && $params['artistId'] !== "") {
                $query = $query->where('artist_id', $params['artistId']);
            }
            $musics = $this->music->paginate($limit, ['*'], 'page', $page);
            $result = [
                'meta' => [
                    'total' => $musics->total(),
                    'per_page' => $musics->perPage(),
                    'current_page' => $musics->currentPage()
                ],
                'records' => $musics->items()
            ];
            return $result;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
