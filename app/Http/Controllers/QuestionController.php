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
    public function index($surveyId=null)
    {
        $questions = $this->getQuestions($surveyId);

        return response()->json($questions);
    }

    public function getQuestions($surveyId){
        return $surveyId?Survey::findOrFail($surveyId)->questions:Question::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $question = new Question();
        $question->text = Input::get('text');
        $question->survey_Id = Input::get('surveyId');
        $question->order = Input::get('order');
        $question->save();

        return response()->json($question);
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
        return response()->json($id);
    }

}
