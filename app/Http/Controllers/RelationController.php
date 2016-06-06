<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


class RelationController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

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
        $data = Input::except('_token');

        foreach($data as $key => $value) {
            //var_dump ($value['relation']==true||$value['is_gna']==true||$value['party_vote']==true);
            if($value['relation']==true||$value['is_gna']==true||$value['party_vote']==true){
                $relation = Relation::firstOrNew(['elector_id' => $key]);
                $value['user_id'] = Auth::user()->id;
                $relation->fill($value);
                $relation->save();
            }


            if(Relation::where('elector_id', $key)->exists() && $value['is_gna']== 0){
                $relation = Relation::firstOrNew(['elector_id' => $key]);
                $value['user_id'] = Auth::user()->id;
                $relation->fill($value);
                $relation->save();
            }

        }
        session()->flash('flash_message', 'Records have been updated!');
        return redirect::back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
