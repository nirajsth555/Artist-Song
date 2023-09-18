<?php

namespace App\Interfaces\ArtistRepositoryInterface;

interface ArtistRepositoryInterface
{
    public function create($data);
    public function update($artistId, $data);
    public function index($request);
    public function delete($artistId);
}
