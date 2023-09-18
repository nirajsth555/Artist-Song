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
            throw new GeneralException(__("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR));
        }
    }
}
