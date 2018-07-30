<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Quiz;
use App\User;


class AdminController extends Controller
{


    public function __construct()
    {

       $this->middleware('admin');
    }


    public function index()
    {

         $quizzes = $this->quizList();

        return view('quizzes.index',[ 'quizzes' => $quizzes ] );
    }

    public function quizList()
    {
        return Quiz::paginate(2);
    }




}
