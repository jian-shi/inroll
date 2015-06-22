<?php namespace App\Inroll\Repositories;
/**
 * Created by PhpStorm.
 * User: jshi
 * Date: 13/01/15
 * Time: 9:27 AM
 */
use Illuminate\Support\Facades\DB;
    abstract class DbRepository{
        public function getAll()
        {
            return $this->model->All();
        }

        public function getById($id)
        {
            return $this->model->find($id);
        }

        public function getByField($match){
            $results = $this->model->where($match)->orderBy(DB::raw('street,MOD(addresses.`house_no`,2),CAST(`addresses`.`house_no` AS DECIMAL)'))
                ->get();
            return $results;
        }

        public function getByName($match,$forename){
            $results = $this->model->where($match)->where('forenames', 'like', "$forename%")->get();
            return $results;
        }
    }