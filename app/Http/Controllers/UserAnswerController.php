<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class UserAnswerController extends Controller
{


    public function add(Request $request){

        //if answer is unique by session id and  question id in user answer_sets
        ( new UserAnswerDataSetController() )->setAnswerDataSet($request);


        if(empty($request->nextQuestion)) {

            //regenerate session
            return redirect('/assessment');
        }

        //redirect to next question
        return redirect('/quizzes/'.$request->quiz_id.'/preview/'.$request->nextQuestion);
    }




    protected function isValidAnswer($answerId, $answerValue)
    {
        return ( \App\Answer::find($answerId)->correct == $answerValue )  ? 1 : 0;
    }


    protected function saveAnswer(Request $request)
    {
        foreach($request->answer as $key => $value){


            //insert individual user  answer
            \App\userAnswer::updateOrCreate(
                [

                    'session_id' =>$request->session()->getId(),
                    'answer_id' => $key,

                ],
                [
                    'user_id' => request()->user()->id,
                    'quiz_id' => $request->quiz_id,
                    'question_id' => $request->questionId,
                    'answer_value' => $value,
                    'is_valid_answer' => $this->isValidAnswer($key, $value)
                ]
            );
        }

    }

}
