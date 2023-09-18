<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\CreateArtistRequest;
use App\Services\ArtistService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// use Illuminate\Http\Response;

class ArtistController extends Controller
{
    use ApiResponser;

    private $artistService;

    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    public function index(Request $request)
    {
        try {
            // throw new GeneralException(__("Internal Server Error.", Response::HTTP_INTERNAL_SERVER_ERROR));
            $artists = $this->artistService->filterArtist($request->all());
            return $this->generalisedResponse("List of artists", true, ['artists' => $artists], Response::HTTP_OK);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function store(CreateArtistRequest $request)
    {
        try {
            $artist = $this->artistService->createArtist($request->all());
            return $this->successResponse($artist, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($artist, CreateArtistRequest $request)
    {
        try {
            $artist = $this->artistService->updateArtist($artist, $request);
            return $this->generalisedResponse("Artist created successfully", true, ['artist' => $artist], Response::HTTP_OK);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($artist)
    {
        try {
            $this->artistService->deleteArtist($artist);
            return $this->generalisedResponse("Artist deleted", true, '', Response::HTTP_OK);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
