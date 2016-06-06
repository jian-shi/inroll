<?php namespace App\Inroll\Repositories;

use App\Elector;

class ElectorRepository extends DbRepository
{

    protected  $model;

    function __construct(Elector $model)
    {
        $this->model = $model;
    }
}
