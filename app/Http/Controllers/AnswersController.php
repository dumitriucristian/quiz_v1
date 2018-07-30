<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Answer;
use App\Question;

class AnswersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function edit(Request $request, $id)
    {
        $answer = Answer::find($id);
        //dd($answer);
        return view('answers.edit', ['answer'=>$answer]);
    }


    public function update(Request $request, $id)
    {

        $answer = Answer::find($id);
        $this->validate(request(), [
            'correct' => 'required',
            'body' => 'required'
        ]);
        $answer->body = $request->body;
        $answer->correct = $request->correct;
        $answer->save();

        return back();
    }


    public function destroy(Request $request, $id)
    {
       Answer::destroy($id);
        return back();
    }
}
