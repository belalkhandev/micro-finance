<?php

namespace App\Repositories\Village;

interface VillageRepositoryInterface
{
    public function all();

    public function store($request);

    public function update($request, $id);

    public function delete($id);

    public function find($id);

    public function duplicate($filters);
}
