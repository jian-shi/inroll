<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Elector;
use App\Age;
use App\Electorate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Inroll\Repositories\ElectorRepository;


class ElectorController extends Controller {
    protected $elector;
	public function __construct(ElectorRepository $elector)
    {
        $this->middleware('auth');
        $this->elector = $elector;
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

        $request->flash();
        $electors=$this->getQueryResult($request);
        $electorate_lists = Electorate::lists('electorate', 'id');
        $age_lists = Age::lists('age_from','age_to', 'id');
        return View('elector.index', compact('electors'))->with('electorates',$electorate_lists)->with('age',$age_lists);
	}

    public function getQueryResult($request)
    {
        $electorate=$request->get('electorate');
        $surname=$request->get('surname');
        $match = ['surname' => $surname];

        if($electorate != '0') {
            $match['electorate_id'] =  $electorate;
        }

        if($forename=$request->get('given_name'))
        {
            $forename =  $forename;
        }

        $electors = $this->elector->getByName($match, $forename);

        return $electors;
    }

    
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Elector $elector)
	{
        return view('elector.show', compact('elector'));
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Elector $elector)
	{
        return view('elector.edit', compact('elector'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Elector $elector, Request $request)
	{
        if ($elector->fill($request->input())->save()) {
            session()->flash('flash_message', 'Record has been updated!');
            return redirect::back();
        }
        else{
            return redirect::back();
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
