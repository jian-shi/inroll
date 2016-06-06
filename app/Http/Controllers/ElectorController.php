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
        $this->electorate_lists = Electorate::lists('electorate', 'id');
        $this->age_lists = Age::lists('age_from','age_to', 'id');
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        if($request->get('surname')){
            $electors=$this->getElectors($request);
            return View('elector.list', compact('electors'))->with('electorates',$this->electorate_lists)->with('age',$this->age_lists);
        }

        return View('elector.index')->with('electorates',$this->electorate_lists)->with('age',$this->age_lists);
    }

    public function getElectors(Request $request)
    {
        $electors = $this->elector->getElectors($request)->paginate(15);
        return $electors;
    }


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

}
