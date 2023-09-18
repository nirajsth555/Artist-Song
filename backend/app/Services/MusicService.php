<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Repositories\MusicRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MusicService
{
    private $musicRepository;

    public function __construct(MusicRepository $musicRepository)
    {
        $this->musicRepository = $musicRepository;
    }

    public function createMusic($data)
    {
        DB::beginTransaction();
        try {
            $music = $this->musicRepository->create($data);
            DB::commit();
            return $music;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateMusic($musicId, $data)
    {
        DB::beginTransaction();
        try {
            $music = $this->musicRepository->update($musicId, $data);
            DB::commit();
            return $music;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteMusic($musicId)
    {
        DB::beginTransaction();
        try {
            $music = $this->musicRepository->delete($musicId);
            DB::commit();
            return $music;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function filterMusic($params)
    {
        try {
            return $this->musicRepository->index($params);
        } catch (\Exception $e) {
            throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
