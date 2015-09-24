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
            $results = $this->model->where($match)->where('forenames', 'like', "$forename%")->orderBy('forenames')->get();
            return $results;
        }

//        public function getSearchResult($match, $occupation, $area_units, $electorates, $dep_from,$dep_to, $age_from, $age_to){
//            $query = DB::table('electors')
//                -> join('addresses',function($join){
//                    $join->on('electors.address_id', '=', 'addresses.id');
//                })
//                -> join('age',function($join){
//                    $join->on('age.id', '=', 'electors.date_of_birth_range');
//                })
//                -> join('census',function($join){
//                    $join->on('census.id', '=', 'addresses.meshblock_id');
//                })
//                -> select(DB::raw('count(electors.id) as elector, count(Distinct CONCAT_WS("/", `addresses`.`house_no`, " ", `addresses`.`flat_no`,`addresses`.`house_alpha`,  " ", `addresses`.`street`)) as address' ))
//
//                -> where ($match)
//                -> where (function($query) use ($occupation, $area_units, $electorates){
//                    $query->where('gna', 0);
//                    $query-> where ('hostile', 0);
//                    if($occupation)
//                        $query->whereIn('electors.occupation_code', $occupation);
//                    if($area_units){
//                        $query->whereIn('census.areaunit_code', $area_units);
//                    }
//                    else{
//                        $query->WhereIn('electors.electorate_id', $electorates);
//                    }
//
//                })
//
//                -> whereBetween('census.nzdep', array($dep_from,$dep_to))
//                -> whereIn('age.id', range($age_from, $age_to))
//                ->get();
//
//            return $query;
//        }

    }