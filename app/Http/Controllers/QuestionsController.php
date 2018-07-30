<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\RedirectResponse;

use App\Question;
use App\Answer;
use App\Category;

class QuestionsController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth');

    }

    public function index()
    {

        $questions = Question::all();
        return view('questions.index',["questions"=> $questions]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('questions.create',['categories'=>$categories]);
    }


    public function store(Request $request)
    {
        $this->validate( request(), [

                'body' => 'required|min:5',
                'category_id'=> 'required|integer'
            ]

        );

        $question = Question::create( [
            'body' => request('body'),
            'category_id' => request('category_id')
        ]);
        $id = $question->id;


        return redirect('questions/'.$id.'/edit');
    }


    public function show($id)
    {
        $question = Question::find($id);

        return view('questions.show', compact('question'));
    }


    public function edit(Request $request, $id)
    {

        $question = Question::find($id);
        $category_id = $question->category->id;

        $categoriesOptions = Category::all()->where('id','<>',$category_id);

        $answers = $question->answers;

        foreach($answers as $key => $value){
          if($value->correct == 1){
              $answers[$key]["option"] = array('text'=>'FALSE', 'id'=>'0');
              $answers[$key]["correct_text"] = 'TRUE';

          }else{
              $answers[$key]["option"]= array('text'=>'TRUE', 'id'=>'1');
              $answers[$key]["correct_text"] = 'FALSE';
          }

        }

        $data = [
            'categoriesOptions' => $categoriesOptions,
            'question'=>$question
        ];

        return view('questions.edit', $data);
    }


    public function update(Request $request, $id)
    {

        $this->validate(request() , [
            'body'=>'required',
            'category_id'=>'required'
        ]);

        $question = Question::find($id);

        $question->body = $request->body;
        $question->category_id = $request->category_id;

        $question->save();

        $request->session()->flash('message', 'Edit successful!');

        return redirect('questions/'.$id.'/edit');
    }


    public function destroy($id)
    {
        Question::destroy($id);
        return back();
    }
}
