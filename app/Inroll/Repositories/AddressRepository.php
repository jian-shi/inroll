<?php namespace App\Inroll\Repositories;

use App\Address;
class AddressRepository extends DbRepository{

    protected $model;
    function __construct(Address $model){
        $this->model = $model;
    }

}