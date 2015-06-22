<?php namespace App\Inroll\Repositories;

use App\Elector;
use App\Inroll\Repositories\DbRepository;

class ElectorRepository extends DbRepository implements ElectorRepositoryInterface
{

    protected  $model;

    function __construct(Elector $model)
    {
        $this->model = $model;
    }
}
