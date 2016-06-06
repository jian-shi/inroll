<?php namespace App\Http\Controllers;

use App\Inroll\Repositories\DbRepository;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\Age;
use App\AreaUnit;
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

    protected $dbRepository;
    public function __construct(DbRepository $dbRepository)
    {
        $this->middleware('auth');
        $this->dbRepository = $dbRepository;
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $request->flash();
        $count_elector = 0;
        $count_address = 0;
        if(Input::get('search')){
            $method = 'search';
            $result=$this->getResult($request, $method);

            if($result){
                $count_elector = $result[0]['elector'];
                $count_address = $result[0]['address'];
            }
            else{
                $count_elector = 0 ;
                $count_address = 0 ;
            }
        }

        if(Input::get('download')){
            $method = 'download';
            $result=$this->getResult($request, $method);
            $this->exportCSV($result);
        }

        $age_lists = Age::lists('age_from', 'id');
        $occupation_lists = Occupation::lists('category','category_id');

        $electorate_lists = Electorate::lists('electorate', 'id');
        $area_lists = AreaUnit::selectRaw('CONCAT(areaunit,"-", areaunit_description) as AreaName, areaunit')->orderBy('areaunit')->lists('AreaName', 'areaunit');

        return view('search')->with('occupation_category',$occupation_lists)->with('age_range',$age_lists)->with('count_elector', $count_elector)->with('count_address', $count_address)->with('electorates',$electorate_lists)->with('areaunits',$area_lists);
    }

    public function getResult($request, $method)
    {
        $result = $this->dbRepository->rawQuery($request, $method);
        return $result;
    }

    public function exportCSV($data)
    {
        Excel::create('Electorate', function($excel) use($data) {
            $excel->sheet('Results', function($sheet) use($data){
                $sheet->fromModel($data);
            });
        })->export('csv');
    }

}
