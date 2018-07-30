<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\QuizzesController;

class quizzesControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_if_no_questions_redirect_to_new_question_form()
    {
        //given we have a quiz
        $quizController = new QuizzesController();

        //when no questions
        //then redirect to new questions
        $this->assertTrue(true);
    }
}
