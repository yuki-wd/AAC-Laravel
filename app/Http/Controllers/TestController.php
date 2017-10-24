<?php

namespace App\Http\Controllers;

use App\Test;
use App\Question;
use App\Option;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        logger('[TestController] : index');
        return response(Test::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // logger($request->all());
        logger('[TestController] : store');
        logger($request);
        $test = new Test();
        $array = array();
        $array = $request->all();
        $test->title = $array['title'];
        $test->save();
        foreach ($array['questions'] as $key => $value) {
            $question = new Question();
            $question->content = $value['content'];
            $question->score = $value['score'];
            $question->test_id = \App\Test::orderBy('id', 'desc')->first()->id;
            $question->save();
            foreach ($value['options'] as $optionkey => $optionvalue) {
                $option = new Option();
                $option->content = $optionvalue['text'];
                $option->isAnswer = $optionvalue['isAnswer']===true ? 1 : 0;
                $option->question_id = \App\Question::orderBy('id', 'desc')->first()->id;
                $option->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Test $test)
    {
        $test_id = $test->id;
        $questions = DB::table('questions')->where('test_id', $test_id)->get();
        $test_arr = json_decode(json_encode($test), true);
        $test_arr["questions"] = array();
        foreach ($questions as $key => $value) {
            $question_id = $value->id;
            $question_content = $value->content;
            $question_score = $value->score;
            $options = DB::table('options')->where('question_id', $question_id)->get();
            $question_arr["id"] = $question_id;
            $question_arr["content"] = $question_content;
            $question_arr["score"] = $question_score;
            $question_arr["options"] = $options;
            array_push($test_arr["questions"], $question_arr);
        }
        return response($test_arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}
