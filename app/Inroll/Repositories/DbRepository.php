<?php namespace App\Inroll\Repositories;
/**
 * Created by PhpStorm.
 * User: jshi
 * Date: 13/01/15
 * Time: 9:27 AM
 */

use Illuminate\Support\Facades\DB;
     class DbRepository{
        public function getAll()
        {
            return $this->model->All();
        }

        public function getById($id)
        {
            return $this->model->find($id);
        }


        public function getAddress($request){
            $request->flash();
            $electorate=$request->get('electorate');
            $street=$request->get('street');

            $query = $this->model->where('street', $street);

            if ($electorate != 0){
                $query->where('electorate_id', $electorate);
            }

            if ($house=$request->get('house')){
                $query->where('house_no', $house);
            };

            $result = $query->orderBy(DB::raw('street,MOD(address.`house_no`,2),CAST(`address`.`house_no` AS DECIMAL)'));

            return $result;
        }


        public function getElectors($request){

            $request->flash();
            $electorate=$request->get('electorate');
            $surname=$request->get('surname');

            $query = $this->model->where('surname', $surname);

            if($electorate != '0') {
                $query->where('electorate_id', $electorate);
            }

            if($forename=$request->get('given_name'))
            {
                $query->where('forenames', 'like', "$forename%");
            }

            $result = $query->orderBy('forenames');
            return $result;
        }



         public function rawQuery($request, $method){
             $electorates=$request->get('electorate');
             $occupation=$request->get('occupation');
             $area_units=$request->get('area_unit');
             $age_from = $request->get('age_from');
             $age_to = $request->get('age_to');
             $dep_from = $request->get('dep_from');
             $dep_to = $request->get('dep_to');
             $ethnic = $request->get('ethnic');
             $export = $request->get('export');



             /*
              * CONCAT_WS will skip any null values, and by using NULLIF any empty ones too.
              */

             if ($method == 'search'){
                 $dbSelect = 'count(electors.id) as elector, count(Distinct CONCAT_WS("/", `address`.`house_no`, " ", `address`.`flat_no`,`address`.`house_alpha`,  " ", `address`.`street`)) as address' ;
                 $subquery = "*";
                 $order = 'elector';
                 $groupBy = "elector";
             }

             if ($method=='download'){
                 if ($export == 'door')
              {
                 $dbSelect = 'CONCAT(CONCAT_WS(" ", CONCAT_WS("/",NULLIF(`address`.`flat_no`, ""),`address`.`house_no`),`address`.`house_alpha`), " ",`address`.`street`) as address,`electors`.`title` as title, CONCAT(`age`.`age_from`,"~",`age`.`age_to`) as age, electors.occupation as occupation, address.street as street, address.suburb_town as address2,`address`.`post_code` as postalCode, `census`.`areaunit` as area_unit,`address`.`city` as city, CONCAT(`electors`.`forenames`," ",`electors`.`surname`) as sort_name, `address`.`id` as addressId, `address`.`route_id` as route_id';
                 $group = ['sort_name','addressId'];
                 $order = 'route_id,street,MOD(address.`house_no`,2),CAST(`address`.`house_no` AS DECIMAL)';
             }
             else {
                 $subquery = 'route_id, house_no, street, address, suburb_town, city, postal_code, GROUP_CONCAT(sort_name SEPARATOR ", ") as name, area_unit, GROUP_CONCAT(first_name) as forenames';
                 $dbSelect = 'address.`house_no` as house_no, CONCAT(CONCAT_WS(" ", CONCAT_WS("/",NULLIF(`address`.`flat_no`, ""),`address`.`house_no`),`address`.`house_alpha`), " ",`address`.`street`) as address, address.flat_no as flat, address.street as street, address.suburb_town as suburb_town,address.city as city, `address`.`post_code` as postal_code, `census`.`areaunit` as area_unit, concat(GROUP_CONCAT(SUBSTRING_INDEX(`electors`.`forenames`, " ", 1)SEPARATOR "/" )," ",`electors`.`surname`)as sort_name, `electors`.`surname` as surname, GROUP_CONCAT(SUBSTRING_INDEX(`electors`.`forenames`, " ", 1) SEPARATOR ", ")as first_name,`address`.`id` as addressId, `address`.`route_id` as route_id';
                 $group = ['addressId','surname'];
                 $order = 'route_id,street,MOD(`house_no`,2),CAST(`house_no` AS DECIMAL)';
                 $groupBy = 'addressId';
             }
             }

             $query = DB::table('electors')
                 -> leftjoin('address',function($join){
                     $join->on('electors.address_id', '=', 'address.id');
                 })
                 -> leftjoin('age',function($join){
                     $join->on('age.id', '=', 'electors.date_of_birth_range');
                 })
                 -> leftjoin('census',function($join){
                     $join->on('census.id', '=', 'address.meshblock');
                 })
                 -> leftjoin('relation',function($join){
                     $join->on('electors.id', '=', 'relation.elector_id');
                 })

                 ->select(DB::raw($dbSelect))

                 ->where(function($query) use ($occupation, $area_units, $electorates){
                     if($occupation)
                         $query->whereIn('electors.occupation_category', $occupation);
                     if($area_units){
                         $query->whereIn('census.areaunit', $area_units);
                     }
                     else{
                         $query->WhereIn('electors.electorate_id', $electorates);
                     }
                 })
                 ->whereIn('age.id', range($age_from, $age_to))
                 ->where(function($query)use ($dep_from,$dep_to){
                     $query->whereNull('census.nzdep')
                           ->orWhereIn('census.nzdep', range($dep_from,$dep_to));})
                 ->where(function($query){
                     $query->whereNull('relation.is_gna')
                         ->orWhere('relation.is_gna', 0);
                 })
                 ->where(function($query){
                     $query->whereNull('relation.relation')
                         ->orWhere('relation.relation','<>', "hostile");
                 })
                 ->where('electors.maori_descent', '!=', 'Y');


             if($ethnic){
                 $query->where('ethnic',$ethnic);
             }

             if($method == 'download'){
                 $query->groupBy($group);
             }

             $data = DB::table( DB::raw("({$query->toSql()}) as sub") )
                 ->mergeBindings($query)
                 ->select(DB::raw($subquery))
                 ->groupBy(DB::raw($groupBy))
                 ->orderBy(DB::raw($order))
                 ->get();


             return $data;
         }
    }