<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Mockery\Exception;
use Psy\Exception\RuntimeException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Question;
use App\Quiz;
use App\Answer;
use App\QuestionValidAnswerSets;
use App\UserAnswer;
use App\UserAnswerSets;

class QuizzesController extends Controller
{



    public function __construct()
    {

       // $this->middleware('auth');
        //$this->middleware('admin');

      //  $this->userRole = Auth::user()->role;
    }


    public function assessment(Request $request)
    {

        //todo - de mutat aceasta metoda in model
        $userAnswerSet = UserAnswerSets::where('session_id', '=', session()->getId() )->get()->first();
        dd($request);
        $quiz_id = $userAnswerSet->quiz_id;
        $quiz = Quiz::find($quiz_id);

        $nrOfQuestions = $quiz->questions->count();
        $userAnswerSet = UserAnswerSets::where('session_id', session()->getId())->get();
        $totalAnswers  = $userAnswerSet->count();
        $validAnswers  = UserAnswerSets::where('session_id', session()->getId())->where('is_valid_answer_set',1)->get()->count();
        $invalidAnswers = UserAnswerSets::where('session_id', session()->getId())->where('is_valid_answer_set',0)->get()->count();
        $skippedAnswer = $totalAnswers - ($validAnswers + $invalidAnswers);
        $averageResult = $validAnswers * 100 / $nrOfQuestions;
        $data = [
            'averageResult' => $averageResult,
            'sessionId'=>session()->getId(),
            'quiz' => $quiz,
            'userAnswerSet' => $userAnswerSet,
            'nrOfQuestions' => $nrOfQuestions,
            'totalAnswers' => $totalAnswers,
            'validAnswers' => $validAnswers,
        ];

        return view('quizzes.assessment', $data);

    }




    public function setAnswer(Request $request, $question_id)
    {

        $this->validate( request(), [
                'body'        => 'required',
                'correct'     => 'required|numeric'
        ]);

        $question = Question::find($question_id);
        $answers = $question->answers;

        $save =  Answer::create([
            'body' => $request->body,
            'question_id' => $question_id,
            'correct' =>$request->correct
        ]) ;

        $questionValidAnswerSet = $question->questionValidAnswerSets ;

        if(   $questionValidAnswerSet == null ){
            //insert answer value
            QuestionValidAnswerSets::create([
                'question_id' => $question_id,
                'valid_answer' => $request->correct
            ]);

        }else{
            $newValidAnswer =  $questionValidAnswerSet->valid_answer.$request->correct;
            $questionValidAnswerSet->valid_answer = $newValidAnswer;
            $questionValidAnswerSet->save();

        }
         return back()->with('Update succeded');
    }

    public function checkCategoriesExist()
    {
         if(\App\Category::all()->count() == 0){
             return false;
         }
         return true;
    }

    public function preview(Request $request, Quiz $quiz, $questionId = false){

        if( $this->checkCategoriesExist()== false){
            return  redirect('/categories');
        };

        //if are no questions redirect to new question form
        if($this->quizHasQuestion($quiz->id) == false ){
            return  redirect('/questions/create');
        };





      //  $quiz               = Quiz::find($quizId);

        $question           = $this->getCurrentQuestion($quiz->id, $questionId);

        //every time a new quiz is started create a new sessions
        if($questionId == false) {
            $request->session()->regenerate();
        }

      //  dd($question);
        $currentQuestionId  = $question->id;

        $previousQuestionId = $this->previousQuestionId($currentQuestionId);
        $nextQuestionId     = $this->nextQuestionId($currentQuestionId);
        $answers            = $question->answers;

        return view('quizzes.preview', [
            'quiz' => $quiz,
            'question'=> $question,
            'answers'=>$answers,
            'nextQuestionId'  => $nextQuestionId,
            'previousQuestionId' => $previousQuestionId
        ]);
     }
    public function quizHasQuestion($quizId)
    {

         if(Quiz::find($quizId)->questions->count() == 0){
             return false;
         };
         return true;


    }
    public function getCurrentQuestion($quizId, $questionId = false)
    {
        $quiz = Quiz::find($quizId);

        if(count($quiz->questions) == 0){

          return  redirect('/questions/create');
        }

        return  ($questionId === false)
            ? $quiz->questions->first()
            : $quiz->questions->where('id','=',$questionId)->first();

    }

    public function previousQuestionId($currentQuestionId)
    {

        $previousQuestion =  Question::where('id', '<', $currentQuestionId)->first();

        return ( empty($previousQuestion)) ? null : $previousQuestion->id ;
    }

    public function nextQuestionId( $currentQuestionId )
    {
        $nextQuestion = Question::where('id', '>', $currentQuestionId)->first() ;
        return   ( empty($nextQuestion )) ? null : $nextQuestion->id;
    }


    public function getQuestion(Request $request, $quizId, $currentQuestionId = false )
    {

        if($currentQuestionId === false){

            $question = Question::whereHas('quizzes')->first();

            $questionArray = $question->toArray();
            $answers = $question->answers->map(function($key){
                 return $key->only('id','question_id','body');
            })->toArray();

            $result = json_encode(array("question"=>$questionArray, "answers"=>$answers));
        }

        return $result;

    }


    public function details($id)
    {

        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions;

        $data = [
          "quiz"=> $quiz,
          "questions" => $questions
        ];

       // dd($questions);
        return view('quizzes.details', $data );
    }

    public function create(Request $request)
    {

        return view('quizzes.create');
    }


    public function store(Request $request)
    {
        $this->validate(request(),[
            'title'=>'required',
            'description' => 'required'
        ]);
        $data = [
            'title' => request('title'),
            'description' => request('description')
        ];

        $quiz = Quiz::create($data);
        $id = $quiz->id;

        return redirect('/quizzes/'.$id.'/edit');
    }



    public function addQuestions(Request $request)
    {

       $quiz = Quiz::findOrFail($request->id);
       //check for unique

        $add = $quiz->questions()->attach($request->question_id);

        return back();
    }

    public function removeQuestions(Request $request)
    {

        $quiz = Quiz::findOrFail($request->id);
        $add = $quiz->questions()->detach($request->question_id);

        return back();
    }


    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id)->first();

        $questions = Question::all();

        $currentQuestions = $quiz->questions;

        $currentQuestionsID = array();

        foreach($currentQuestions as $question){
            array_push($currentQuestionsID, $question->id);
        }


        $availableQuestions = $questions->whereNotIn('id',$currentQuestionsID);

        $data = [
            "availableQuestions"=>$availableQuestions,
            "currentQuestions" => $currentQuestions,
            "quiz" => $quiz
        ];

        return view('quizzes.edit',$data);

    }


    public function update(Request $request, $id)
    {

        $this->validate(request() , [
            'title'=>'required',
            'description'=>'required'
        ]);

        $quiz = Quiz::find($id);

        $quiz->title = $request->title;
        $quiz->description = $request->description;

        $quiz->save();

        return back();
    }


    public function destroy(Quiz $quiz)
    {
        //
    }
}
