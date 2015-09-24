<?php

namespace App\Http\Controllers;

use App\Phone;
use App\Electorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhoneController extends Controller
{
    protected $phone;
    protected $electorate_lists;
    public function __construct(Phone $phone)
    {
        $this->middleware('auth');
        $this->phone = $phone;
        $this->electorate_lists = Electorate::lists('electorate','id');

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('phone.index')->with('electorates',$this->electorate_lists);
    }

    public function show(Request $request){

        $request->flash();
        $electorate=$request->get('electorate');
        $street=$request->get('street');
        $match['addresses.street'] = $street;

        if ($electorate != 0){
            $match ['addresses.electorate_id']= $electorate;
        }

        if ($suburb=$request->get('suburb')){
            $match ['addresses.suburb_town'] =$suburb;
        }

        if ($house=$request->get('house')){
            $match ['addresses.house_no'] = $house;
        };

        $phones = Phone::select()->leftjoin('electors',function($join){
            $join->on('electors.id', '=', 'phone.elector_id');
        })
            -> leftjoin('addresses',function($join){
                $join->on('electors.address_id', '=', 'addresses.id');
            })
            
            ->where($match)
            ->groupby('landline')
            ->get();



        return View('phone.list', compact('phones'))->with('electorates', $this->electorate_lists);

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

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return Response
//     */
//    public function show($id)
//    {
//        //
//    }

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
