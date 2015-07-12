<?php

namespace App\Http\Controllers;

use App\Elector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
class DbManageController extends Controller
{


    public function index()
    {
        return view('db');
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
    public function update()
    {

        DB::table('electors')
            ->update(['address_id' => DB::raw('concat(`electorate_id`,"_",`meshblock_id`,"_",`house_no`,"_",`flat_no`,"_",
   `house_alpha`,"_",`street`)')]);
        echo "1 sucess";
        DB::table('addresses')->truncate();
        try{
            DB::statement('insert ignore addresses (id, electorate_id ,meshblock_id,
                flat_no ,
                house_no ,
                house_alpha,
                street ,
                suburb_town ,
                city,
                post_code)
                select e.address_id, e.electorate_id ,e.meshblock_id,
                e.flat_no ,
                e.house_no ,
                e.house_alpha,
                e.street ,
                e.suburb_town ,
                e.city,
                e.post_code from electors e
                where 1=1');
            session()->flash('flash_message', 'Record has been updated!');

        }catch(\Exception $e){
            echo $e;
        }
        try{
            DB::statement('update electors e
            left join relation r
            on e.id =r.elector_id
            left join electors_may em
            on em.id=r.elector_id
            set r.is_gna=0
            where e.street != em.street');
            session()->flash('flash_message', 'GNA info updated !');

        }catch(\Exception $e){
            echo $e;
        }


        return view('db');



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
