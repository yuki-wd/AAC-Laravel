<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Option::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ここに仮で答え合わせの処理を書く（本来はstoreに書くべきではない）
        $test_id = $request->testId;
        $question_cnt = count(\App\Question::where('test_id', $test_id)->get());
        $correct_cnt = 0;
        $score = 0;
        $total_score = \App\Question::where('test_id', $test_id)->sum('score');
        foreach ($request->answers as $key => $value) {
          $option_id = $value['answerId'];
          $option_is_answer = \App\Option::where('id', $option_id)->get()->first()->isAnswer;
          $question_id = \App\Option::where('id', $option_id)->get()->first()->question_id;
          if ($option_is_answer === 1) {
            $correct_cnt++;
            $score += \App\Question::where('id', $question_id)->get()->first()->score;
          }
        }
        $result = array('question_cnt' => $question_cnt, 'correct_cnt' => $correct_cnt, 'score' => $score, 'total_score' => $total_score);
        return response($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        return response($option);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
