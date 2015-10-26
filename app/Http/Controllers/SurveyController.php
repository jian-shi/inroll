<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(Survey::get());
//        if ($id == null) {
//            $surveys = Survey::orderBy('id', 'desc')->get();
//            return View('survey.index', compact('surveys'));
//        } else {
//            return $this->show($id);
//        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('survey.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Question::create(array(
        'description' => Input::get('description'),
        'start_date' => Input::get('start_date'),
        'end_date' => Input::get('end_date'),
        'is_open' => Input::get('is_open'),
        'number_of_questions' => Input::get('number_of_questions')
        ));
        return response()->json(array('success' => true));
//        $start_date = date("Y-m-d", strtotime($request->input('start_date')));
//        $end_date = date("Y-m-d", strtotime($request->input('end_date')));
//
//
//        $survey = new Survey;
//        $survey-> description = $request->input('description');
//        $survey-> start_date = $start_date;
//        $survey-> end_date = $end_date;
//        $survey-> is_open = $request->input('is_open');
//        $survey-> number_of_questions = $request->input('number_of_questions');
//        $survey->save();


//        return 'Survey successfully created with id ' . $survey->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return response()->json(Survey::where('id',$id)->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Survey $survey)
    {
        return view('survey.edit', compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $survey = Survey::find($id);

        $survey-> description = $request->input('description');
        $survey-> start_date = $request->input('start_date');
        $survey-> end_date = $request->input('end_date');
        $survey-> is_open = $request->input('is_open');
        $survey->save();

        return redirect('survey');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Survey::destroy($id);
        return Response::json(array('success' => true));
    }
}
