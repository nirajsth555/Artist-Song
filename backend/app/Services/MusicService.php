<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Repositories\ArtistRepository;
use App\Repositories\MusicRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MusicService
{
    private $musicRepository, $artistRepository;

    public function __construct(MusicRepository $musicRepository, ArtistRepository $artistRepository)
    {
        $this->musicRepository = $musicRepository;
        $this->artistRepository = $artistRepository;
    }

    public function createMusic($data)
    {
        DB::beginTransaction();
        try {
            $this->artistRepository->show($data['artist']);
            $music = $this->musicRepository->create($data);
            DB::commit();
            return $music;
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw new GeneralException("Artist not found", Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateMusic($musicId, $data)
    {
        DB::beginTransaction();
        try {
            $this->artistRepository->show($data['artist']);
            $music = $this->musicRepository->update($musicId, $data);
            DB::commit();
            return $music;
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw new GeneralException("Artist not found", Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            // throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
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
            throw $e;
            // throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function filterMusic($params)
    {
        try {
            return $this->musicRepository->index($params);
        } catch (\Exception $e) {
            throw $e;
            // throw new GeneralException("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
