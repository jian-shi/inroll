<?php namespace App\Inroll\Repositories;

use App\Address;
use App\Inroll\Repositories\DbRepository;
use Illuminate\Support\Facades\DB;
class AddressRepository extends DbRepository implements AddressRepositoryInterface{

    protected $model;

    function __construct(Address $model){
        $this->model = $model;
    }

}