<?php namespace App\Http\Controllers;


use App\Address;
use App\Electorate;
use Illuminate\Http\Request;
use App\Inroll\Repositories\AddressRepository;

class AddressController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /addresses
	 * 
	 * @return Response
	 */
    protected $address;
    protected $electorate_lists;
    public function __construct(AddressRepository $address)
    {
        $this->middleware('auth');
        $this->address = $address;
        $this->electorate_lists = Electorate::lists('electorate', 'id');
    }

	public function index()
	{
        return View('address.index')->with('electorates',$this->electorate_lists);
	}

    public function query(Request $request)
    {
        $request->flash();
        $addressId = $request->get('addressId');
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

        return View('address.relation', compact('addresses'))->with('electorates', $this->electorate_lists);

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