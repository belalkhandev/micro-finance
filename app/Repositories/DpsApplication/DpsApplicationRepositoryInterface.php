<?php

namespace App\Repositories\DpsApplication;

interface DpsApplicationRepositoryInterface
{
    public function allApplications($request);

    public function getByPaginate($request, $limit);

    public function store($request);

    public function update($request, $id);

    public function delete($id);

    public function find($id);

    public function updateStatus($id, $status);

    public function memberDps($member_id);

    public function memberDpsTransactions($member_id);

    public function dpsTransactions($dps_id);

}
