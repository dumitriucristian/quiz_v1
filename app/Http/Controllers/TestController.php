<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Quiz;

class TestController extends Controller
{
   public function index(Quiz $quiz)
   {
       dd($quiz->id);
   }
}
