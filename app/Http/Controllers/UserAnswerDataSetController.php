<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAnswerDataSetController extends Controller
{


    public function setAnswerDataSet(Request $request)
    {

        $userAnswerDataSet = $this->formatData($request->answer);

        $validAnswerSet = $this->getValidAnswerSet($request->question_id);

        $isValidAnswerSet =  $this->isValidUserAnswerSet($userAnswerDataSet, $validAnswerSet);

        $answerCredentials = $this->prepareAnswerCredentials($request);

        $answerData = $this->prepareData($request, $userAnswerDataSet, $isValidAnswerSet) ;

        if(!$isValidAnswerSet)
        {
            return false;
        }

        return $this->saveUserAnswerDataSet($answerCredentials, $answerData);

    }


    protected function saveUserAnswerDataSet($answerCredentials, $answerData)
    {
       return  \App\UserAnswerSets::saveUserAnswerDataSet($answerCredentials, $answerData);
    }

    protected function getValidAnswerSet($questionId)
    {
        return  \App\Question::find($questionId)->validAnswerSets->valid_answer;

    }

    protected function prepareAnswerCredentials($request)
    {

        return   [
                    'session_id' => $request->session()->getId(),
                    'question_id' =>$request->question_id,
                  ];
    }



    protected function prepareData($request, $userAnswerDataSet, $isValidAnswerSet)
    {
        return   [
                    'user_id' => $request->user()->id,
                    'quiz_id' => $request->quiz_id,
                    'user_answer_set' => $userAnswerDataSet,
                    'is_valid_answer_set' => $isValidAnswerSet,
                 ];
    }


    protected function isValidUserAnswerSet( $userAnswerDataSet, $validAnswerSet)
    {

        return ($userAnswerDataSet === $validAnswerSet) ? 1 : 0 ;

    }


    protected function formatData($answer)
    {
        return implode('', $answer);
    }


}
