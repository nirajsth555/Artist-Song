<?php

namespace App\Services;

use App\Exceptions\GeneralException;
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
            throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateArtist($artistId, $data)
    {
        DB::beginTransaction();
        try {
            $artist = $this->artistRepository->update($artistId, $data);
            DB::commit();
            return $artist;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteArtist($artistId)
    {
        DB::beginTransaction();
        try {
            $artist = $this->artistRepository->delete($artistId);
            DB::commit();
            return $artist;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function filterArtist($params)
    {
        try {
            return $this->artistRepository->index($params);
        } catch (\Exception $e) {
            throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
