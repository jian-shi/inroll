<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(Question::get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        Question::create(array(
            'text' => Input::get('text'),
            'survey_id' => Input::get('survey_id')
        ));
        return response()->json(array('success' => true));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Question::destroy($id);
        return Response::json(array('success' => true));
    }
}
