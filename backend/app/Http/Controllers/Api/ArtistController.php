<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\CreateArtistRequest;
use App\Services\ArtistService;
use App\Traits\ApiResponser;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;

class ArtistController extends Controller
{
    use ApiResponser;

    private $artistService;

    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    public function store(CreateArtistRequest $request)
    {
        try {
            $artist = $this->artistService->createArtist($request->all());
            return $this->successResponse($artist, 201);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
