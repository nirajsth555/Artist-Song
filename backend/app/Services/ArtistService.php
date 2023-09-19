<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Artist;
use App\Repositories\ArtistRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ArtistService
{
    private $artistRepository;

    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    public function createArtist($data)
    {
        DB::beginTransaction();
        try {
            $artist = $this->artistRepository->create($data);
            DB::commit();
            return $artist;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            // throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateArtist(Artist $artist, $data)
    {
        DB::beginTransaction();
        try {
            $artist = $this->artistRepository->update($artist, $data);
            DB::commit();
            return $artist;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            // throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteArtist(Artist $artist)
    {
        DB::beginTransaction();
        try {
            $artist = $this->artistRepository->delete($artist);
            DB::commit();
            return $artist;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            // throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function filterArtist($params)
    {
        try {
            return $this->artistRepository->index($params);
        } catch (\Exception $e) {
            throw $e;
            // throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
