<?php

namespace App\Models;

class CSVModelRepository
{
    /** @var CSVModel[] */
    private $repository = [];

    public function add(CSVModel $model): void
    {
        $this->repository[] = $model;
    }

    /**
     * @return CSVModel[]
     */
    public function getRepository()
    {
        return $this->repository;
    }
}
