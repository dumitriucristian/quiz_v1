<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use \App\User;

class PageIsOkTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp()
    {
        parent::setUp();
        $this->setFakeUser();
    }

    public function setFakeUser()
    {

        //make a fake admin
        $user = factory( User::class)->make(['role' => 'admin'] );
        $response = $this->actingAs($user )->withSession(['foo' => 'bar']);

        return $user;
    }

    /** @test */
    public function homepage_is_ok()
    {

        $this->get('/')->assertStatus(200);


    }

    public function dashboard_is_ok()
    {

        $this->get('/dashboard')->assertStatus(200);
    }

    public function quizzes_is_ok()
    {

        $this->get('/quizzes/1/preview')->assertStatus(200);
    }

    public function quizzes_next_is_ok()
    {

        $this->get('http://homestead.test/quizzes/1/preview/2')->assertStatus(200);
    }

    public function quiz_edit_is_ok()
    {

        $this->get('quizzes/1/edit')->assertStatus(200);
    }

    public function new_question_is_ok()
    {

        $this->get('questions/create')->assertStatus(200);
    }

    public function categories_is_ok()
    {

        $this->get('/categories')->assertStatus(200);
    }


}
