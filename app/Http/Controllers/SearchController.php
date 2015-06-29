<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Age;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Electorate;
class SearchController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $request->flash();
        if(Input::all()){
        $result=$this->getQueryResult();
        $count_elector = $result['elector'];
        $count_address = $result['address'];
        }
        else{
        $count_elector = "0";
        $count_address = "0";}
        $age_lists = Age::lists('age_from', 'id');
        $electorate_lists = Electorate::lists('electorate', 'id');
        return view('search')->with('age_range',$age_lists)->with('count_elector', $count_elector)->with('count_address', $count_address)->with('electorates',$electorate_lists);
    }

    public function getQueryResult()
    {
        $electorates = Input::get('electorate');
        $ethnic=Input::get ('ethnic');
        $area_unit=Input::get ('area_unit');
        $match =[];
        if ($ethnic != null){
            $match['electors.ethnic'] = $ethnic;
        }
        if ($area_unit != null){
            $match['census.areaunit_code'] = $area_unit;
        }


        $age_from = Input::get('age_from');
        $age_to = Input::get('age_to');
        $dep_from = Input::get('dep_from');
        $dep_to = Input::get('dep_to');
        $request = ['electorates'=>$electorates,'match'=>$match, 'age_from'=>$age_from, 'age_to'=>$age_to,'dep_from'=>$dep_from, 'dep_to'=>$dep_to];
        Session::put('request', $request);

        $count = DB::table('electors')
            -> join('addresses',function($join){
                $join->on('electors.address_id', '=', 'addresses.id');
            })
            -> join('age',function($join){
                $join->on('age.id', '=', 'electors.date_of_birth_range');
            })
            -> join('census',function($join){
                $join->on('census.id', '=', 'addresses.meshblock_id');
            })
            -> select(DB::raw('count(electors.id) as elector, count(Distinct CONCAT_WS("/", `addresses`.`house_no`, " ", `addresses`.`flat_no`,`addresses`.`house_alpha`,  " ", `addresses`.`street`)) as address' ))
            -> where ($match)
            -> whereIn('electors.electorate_id', $electorates)
            -> whereBetween('census.nzdep', array($dep_from,$dep_to))
            -> whereIn('age.id', range($age_from, $age_to))
            -> where('gna', 0)
            -> where ('hostile', 0)
            -> get();

        return $count[0];
    }

    public function export()
    {
        $savedRequest = Session::get('request');
        $match = $savedRequest['match'];
        $electorates = $savedRequest['electorates'];
        $age_from = $savedRequest['age_from'];
        $age_to = $savedRequest['age_to'];
        $dep_from = $savedRequest['dep_from'];
        $dep_to = $savedRequest['dep_to'];
        $export = Input::get('export');

        if ($export=='door') {

            $dbSelect = 'CONCAT(CONCAT_ws("", CONCAT_ws("/",`addresses`.`flat_no`,`addresses`.`house_no`),`addresses`.`house_alpha`), " ",`addresses`.`street`) as address, addresses.street as street, addresses.suburb_town as address2,`addresses`.`post_code` as postalCode, `census`.`areaunit_code` as area_unit,`addresses`.`city` as city, CONCAT(`electors`.`forenames`," ",`electors`.`surname`) as name';
            $group = ['name','address'];
        }
        else {

            $dbSelect = 'CONCAT(CONCAT_ws("", CONCAT_ws("/",`addresses`.`flat_no`,`addresses`.`house_no`),`addresses`.`house_alpha`), " ",`addresses`.`street`) as address, addresses.street as street, addresses.suburb_town as address2,`addresses`.`post_code` as postalCode, `census`.`areaunit_code` as area_unit,`addresses`.`city` as city, GROUP_CONCAT(CONCAT(SUBSTRING(`electors`.`forenames` from 1 for 1)," ",`electors`.`surname`) SEPARATOR ", ")as name';
            $group = 'address';
        }

        $data = DB::table('electors')
            -> leftjoin('addresses',function($join){
                $join->on('electors.address_id', '=', 'addresses.id');
            })

            -> leftjoin('age',function($join){
                $join->on('age.id', '=', 'electors.date_of_birth_range');
            })
            -> leftjoin('census',function($join){
                $join->on('census.id', '=', 'addresses.meshblock_id');
            })
            -> leftjoin('relation',function($join){
                $join->on('electors.id', '=', 'relation.elector_id');
            })

            ->select(DB::raw($dbSelect))
            ->where($match)
            ->whereIn('electors.electorate_id', $electorates)
            ->whereIn('age.id', range($age_from, $age_to))
            ->whereIn('census.nzdep', range($dep_from,$dep_to))
            ->where(function($query){
                $query->whereNull('relation.is_gna')
                      ->orWhere('relation.is_gna', 0);
            })
            ->where(function($query){
                $query->whereNull('relation.is_hostile')
                    ->orWhere('relation.is_hostile', 0);
            })
            ->groupBy($group)
            ->orderBy(DB::raw('area_unit,street,MOD(addresses.`house_no`,2),CAST(`addresses`.`house_no` AS DECIMAL)'))
            ->get();


        Excel::create('Electorate', function($excel) use($data) {
            $excel->sheet('Results', function($sheet) use($data){

                $sheet->fromModel($data);

            });

        })->export('csv');

    }

}
