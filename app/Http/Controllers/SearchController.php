<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Age;
use App\AreaUnit;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Electorate;
use App\Occupation;
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
        $occupation_lists = Occupation::lists('category','category');

        $electorate_lists = Electorate::lists('electorate', 'id');
        $area_lists = AreaUnit::selectRaw('CONCAT(areaunit_code,"-", areaunit_description) as AreaName, areaunit_code')->orderBy('areaunit_code')->lists('AreaName', 'areaunit_code');

        return view('search')->with('occupation_category',$occupation_lists)->with('age_range',$age_lists)->with('count_elector', $count_elector)->with('count_address', $count_address)->with('electorates',$electorate_lists)->with('areaunits',$area_lists);
    }

    public function getQueryResult()
    {
        $electorates = Input::get('electorate');
        $ethnic= Input::get ('ethnic');
        $area_units= Input::get ('area_unit');
        $occupation= Input::get ('occupation');

            $match =[];
            if ($ethnic != null){
                $match['electors.ethnic'] = $ethnic;
            }

            $age_from = Input::get('age_from');
            $age_to = Input::get('age_to');
            $dep_from = Input::get('dep_from');
            $dep_to = Input::get('dep_to');
            $request = ['electorates'=>$electorates,'match'=>$match, 'area_units'=>$area_units,'occupation'=>$occupation,'age_from'=>$age_from, 'age_to'=>$age_to,'dep_from'=>$dep_from, 'dep_to'=>$dep_to];
            Session::put('request', $request);

            $query = DB::table('electors')
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
                -> where (function($query) use ($occupation, $area_units, $electorates){
                    if($occupation)
                        $query->whereIn('electors.occupation_code', $occupation);
                    if($area_units){
                        $query->whereIn('census.areaunit_code', $area_units);
                        }
                    else{
                        $query->WhereIn('electors.electorate_id', $electorates);
                        }

                })

                -> whereBetween('census.nzdep', array($dep_from,$dep_to))
                -> whereIn('age.id', range($age_from, $age_to))
                ->get()
            ;

        return $query[0];


    }

    public function export()
    {
        $savedRequest = Session::get('request');
        $match = $savedRequest['match'];
        $electorates = $savedRequest['electorates'];
        $area_units= $savedRequest ['area_units'];
        $occupation= $savedRequest ['occupation'];


        $age_from = $savedRequest['age_from'];
        $age_to = $savedRequest['age_to'];
        $dep_from = $savedRequest['dep_from'];
        $dep_to = $savedRequest['dep_to'];
        $export = Input::get('export');

        if ($export=='door') {

            $dbSelect = 'CONCAT(CONCAT_WS(" ", CONCAT_WS("/",`addresses`.`flat_no`,`addresses`.`house_no`),`addresses`.`house_alpha`), " ",`addresses`.`street`) as address,`electors`.`title` as title, CONCAT(`age`.`age_from`,"~",`age`.`age_to`) as age, electors.occupation as occupation, addresses.street as street, addresses.suburb_town as address2,`addresses`.`post_code` as postalCode, `census`.`areaunit_code` as area_unit,`addresses`.`city` as city, CONCAT(`electors`.`forenames`," ",`electors`.`surname`) as name, `addresses`.`id` as addressId, `addresses`.`route_id` as route_id';
            $group = ['name','addressId'];
        }
        else {

            $dbSelect = 'CONCAT(CONCAT_WS(" ", CONCAT_WS("/",`addresses`.`flat_no`,`addresses`.`house_no`),`addresses`.`house_alpha`), " ",`addresses`.`street`) as address, addresses.flat_no as flat, addresses.street as street, addresses.suburb_town as address2,`addresses`.`post_code` as postalCode, `census`.`areaunit_code` as area_unit,`addresses`.`city` as city, GROUP_CONCAT(CONCAT(SUBSTRING(`electors`.`forenames` from 1 for 1)," ",`electors`.`surname`) SEPARATOR ", ")as name,`addresses`.`id` as addressId, `addresses`.`route_id` as route_id';
            $group = 'addressId';
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
            ->where(function($query) use ($occupation, $area_units, $electorates){
                if($occupation)
                    $query->whereIn('electors.occupation_code', $occupation);
                if($area_units){
                    $query->whereIn('census.areaunit_code', $area_units);
                }
                else{
                    $query->WhereIn('electors.electorate_id', $electorates);
                }

            })
            ->whereIn('age.id', range($age_from, $age_to))
            ->whereIn('census.nzdep', range($dep_from,$dep_to))
            ->where(function($query){
                $query->whereNull('relation.is_gna')
                      ->orWhere('relation.is_gna', 0);
            })
            ->where(function($query){
                $query->whereNull('relation.relation')
                    ->orWhere('relation.relation','<>', "hostile");
            })
            ->where('electors.maori_descent', '!=', 'Y')
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
