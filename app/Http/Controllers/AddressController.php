<?php namespace App\Http\Controllers;

//use Illuminate\Routing\Controller;
use App\Address;
use App\Electorate;
use App\Feedback;
use Illuminate\Http\Request;
use App\Inroll\Repositories\AddressRepository;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AddressController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /addresses
	 * 
	 * @return Response
	 */
    protected $address;
    public function __construct(AddressRepository $address)
    {
        $this->middleware('auth');
        $this->address = $address;
    }

	public function index()
	{
        $electorate_lists = Electorate::lists('electorate', 'id');
        return View('address.index')->with('electorates',$electorate_lists);
	}

    public function query(Request $request)
    {
        $request->flash();
        $electorate_lists = Electorate::lists('electorate', 'id');
        $electorate=$request->get('electorate');
        $street=$request->get('street');
        $match['street'] = $street;

        if ($electorate != 0){
            $match = array_add ($match, 'electorate_id', $electorate);
        }

        if ($suburb=$request->get('suburb')){
            $match = array_add ($match, 'suburb_town', $suburb);
        }

        if ($house=$request->get('house')){
            $match = array_add ($match, 'house_no', $house);
        };

        $addresses = $this->address->getByField($match);

        return View('address.door', compact('addresses'))->with('electorates', $electorate_lists);

    }

	/**
	 * Show the form for creating a new resource.
	 * GET /addresses/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /addresses
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /addresses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Address $address)
	{
        return view('address.show', compact('address'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /addresses/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Address $address, Request $request)
	{
        //
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /addresses/{id}
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
	 * DELETE /addresses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}



}