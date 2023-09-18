<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Music\CreateMusicRequest;
use App\Services\MusicService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MusicController extends Controller
{
    use ApiResponser;

    private $musicService;

    public function __construct(MusicService $musicService)
    {
        $this->musicService = $musicService;
    }

    public function index(Request $request)
    {
        try {
            $artists = $this->musicService->filterMusic($request->all());
            return $this->generalisedResponse("List of music", true, ['artists' => $artists], Response::HTTP_OK);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function store(CreateMusicRequest $request)
    {
        try {
            $music = $this->musicService->createMusic($request->all());
            return $this->successResponse($music, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($music, CreateMusicRequest $request)
    {
        try {
            $music = $this->musicService->updateMusic($music, $request);
            return $this->generalisedResponse("Music updated successfully", true, ['music' => $music], Response::HTTP_OK);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($music)
    {
        try {
            $this->musicService->deleteMusic($music);
            return $this->generalisedResponse("Music deleted", true, '', Response::HTTP_OK);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
