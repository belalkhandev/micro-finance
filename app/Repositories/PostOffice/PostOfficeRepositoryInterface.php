<?php

namespace App\Repositories\PostOffice;

interface PostOfficeRepositoryInterface
{
    public function all();

    public function store($request);

    public function update($request, $id);

    public function delete($id);

    public function find($id);

    public function duplicate($filters);
}
